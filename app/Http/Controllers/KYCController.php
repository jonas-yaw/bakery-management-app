<?php

namespace App\Http\Controllers;

use Crypt;
use DateTime;
use Response;
use Carbon\Carbon;
use App\Models\Bill;
use App\Models\User;
use App\Models\Agent;
use App\Models\Title;
use App\Models\Branch;
use App\Models\Gender;
use App\Models\Customer;
use App\Models\Profession;
use App\Models\AccountType;

use App\Models\DocComments;
use Illuminate\Support\Str;
use App\Models\Reservations;
use App\Models\SalesChannel;
use Illuminate\Http\Request;
use App\Models\AttachDocuments;
use App\Models\IdentificationType;
use Illuminate\Support\Facades\Auth;

class KYCController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCustomers(){
        $users   =  User::all();
        $gender =  Gender::get();
        $identificationtypes = IdentificationType::get();
        $sale_channels = SalesChannel::get();
        $accounttype = AccountType::orderBy('type', 'ASC')->get();
        $professions = Profession::get();

        $customers = Customer::where('created_by',Auth::user()->getNameOrUsername())->where('status','Active')->orderby('created_on','desc')->paginate(30);
        $inactive_customers = Customer::where('created_by',Auth::user()->getNameOrUsername())->where('status','Deactive')->orderby('created_on','desc')->paginate(30);
        

        return view('customer.index', compact('users','gender','identificationtypes','sale_channels','accounttype','professions','customers','inactive_customers'));
    }

    public function registerCustomer()
    {
        $users               =  User::all();
        $gender              =  Gender::get();
        $identificationtypes = IdentificationType::get();
        $sale_channels       = SalesChannel::get();
        $accounttype         = AccountType::orderBy('type', 'ASC')->get();
        $professions         = Profession::get();
        $titles              = Title::get();

        return view('customer.register', compact('users', 'gender', 'identificationtypes', 'professions', 'sale_channels', 'accounttype', 'titles'));
    }

    public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y', $date);
        return $time->format('Y-m-d');
    }

    function generateCustomerID()
    {
        $branch = Branch::where('branch_name', Auth::user()->getBranch())->first();
        $count = $branch->clients_count;
        $prefix = $branch->branch_prefix;


        $customer_number = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $year = date('Y');
        $generated = $year . $prefix . $customer_number;

        Branch::where('branch_name', Auth::user()->getBranch())->increment('clients_count', 1);

        return $generated;
    }

    public function postNewCustomer(Request $request)
    {


        $selectedaccount = $request->get('account_type');

        if ($selectedaccount == 'Individual') {
            $insured = Str::of($request->get('firstName'))->trim('/') . ' ' . Str::of($request->get('otherName'))->trim('/') . ' ' . Str::of($request->get('lastName'))->trim('/');
            $first_name = $request->get('firstName') . ' ' . $request->get('otherName');
            $last_name = $request->get('lastName');
        }else {
            $insured = Str::of($request->get('companyname'))->trim('/');
            $split = explode(' ',Str::of($request->get('companyname'))->trim(' '),2);
            $first_name =$split[0];
            $last_name = $split[1];
        }

        $fullname = Str::of($insured)->squish();

        if ($user = Customer::where('mobile_number', $request->get('mobile_number'))->where('fullname', $fullname)->first()) {
            $added_response = array('Duplicate' => 'Duplicate');
            return  Response::json($added_response);
        } else {

            $communication_channel = $request->get('communication_channel') == null ? null : implode(',', $request->get('communication_channel'));
            $genaccountnumber = $this->generateCustomerID();

            $customer = new Customer;
            $customer->account_number  = $genaccountnumber;
            $customer->fullname = ucwords(strtolower($fullname));
            $customer->first_name = $first_name;
            $customer->last_name = $last_name;

            $customer->title = $request->get('title');
            $customer->account_manager = $request->get('account_manager');
            $customer->postal_address = $request->get('postal_address');
            $customer->residential_address = $request->get('residential_address');
            $customer->email = $request->get('email');
            $customer->mobile_number = $request->get('mobile_number');
            $customer->mobile_number_2 = $request->get('mobile_number_2');
            $customer->mobile_number_3 = $request->get('mobile_number_3');

            if($request->get('date_of_birth')){
                $customer->date_of_birth = $this->change_date_format($request->get('date_of_birth'));
            }

            $customer->field_of_activity = $request->get('field_of_activity');
            $customer->id_type   = $request->get('id_type');
            $customer->id_number = $request->get('id_number');

            $customer->gender = $request->get('gender');
            $customer->sales_channel = $request->get('sales_channel');
            $customer->account_type = $request->get('account_type');
            $customer->status = 'Active';
            $customer->created_on = Carbon::now();
            $customer->created_by = Auth::user()->getNameOrUsername();
            $customer->branch = Auth::user()->getBranch();
            $customer->communication_channel = $communication_channel;


            if ($customer->save()) {
                $added_response = array('OK' => 'OK', 'ReferenceNumber' => encrypt($genaccountnumber));
                return  Response::json($added_response);
            } else {
                return redirect()
                    ->route('get-customers')
                    ->with('error', 'Account failed to create!');
            }
        }
    }


    public function editCustomer(Request $request)
    {

        $user_id = $request->id;
        $user = Customer::find($user_id);

        $dob = $user->date_of_birth ? $user->date_of_birth->format('d/m/Y') : '';
        $data = array(
            'account_id' => $user->id,
            'account_number' => $user->account_number,
            'account_type' => $user->account_type,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'fullname' => $user->fullname,
            'residential_address' => $user->residential_address,
            'postal_address' => $user->postal_address,
            'date_of_birth' =>  $dob,
            'email' => $user->email,
            'field_of_activity' => $user->field_of_activity,
            'image' => $user->image,
            'mobile_number' => $user->mobile_number,
            'mobile_number_2' => $user->mobile_number_2,
            'mobile_number_3' => $user->mobile_number_3,
            'account_manager' => $user->account_manager,
            'sales_channel' => $user->sales_channel,
            'gender' => $user->gender
        );
        return Response::json($data);
    }

    public function updateCustomer(Request $request)
    {
        try {


            $id                  = $request->account_id;
            $account_type        = $request->account_type;
            $account_number      = $request->account_number;
            $first_name          = Str::of(strtoupper( $request->first_name))->trim(' ');
            $last_name           = Str::of(strtoupper( $request->last_name))->trim(' ');
            //$fullname            = strtoupper(Input::get("fullname"));

            if($first_name == $last_name ){
                $fullname = $first_name;
            }else{
                if($request->account_type == 'Joint'){
                    $fullname = $first_name . ' / ' . $last_name;
                }else{
                    $fullname = Str::of($first_name)->trim('/') .' '. Str::of($last_name)->trim('/');
                }
            }
            
            $account_manager     = $request->account_manager;
            $residential_address = $request->residential_address;
            $postal_address      = $request->postal_address;
            $email               = $request->email;
            $mobile_number       = $request->mobile_number;
            $field_of_activity   = $request->field_of_activity;
            $date_of_birth       = $this->change_date_format($request->date_of_birth);
            $sales_channel       = $request->sales_channel;
            $gender              = $request->gender;



            //dd($id);

            $affectedRows = Customer::find($id)
                ->update([

                    'account_type' =>  $account_type,
                    'first_name' =>  $first_name,
                    'last_name' =>  $last_name,
                    'fullname' =>  $fullname,
                    'account_manager' =>  $account_manager,
                    'residential_address' => $residential_address,
                    'postal_address' => $postal_address,
                    'email' => $email,
                    'mobile_number' =>  $mobile_number,
                    'field_of_activity' => $field_of_activity,
                    'date_of_birth' => $date_of_birth,
                    'sales_channel' => $sales_channel,
                    'gender' => $gender,
                    'updated_on' => Carbon::now()
                ]);


            $affectedRows2 = Reservations::where('account_number', $account_number)
                ->update(['fullname' =>  $fullname]);

            $affectedRows3 = Bill::where('account_number', $account_number)
                ->update(['fullname' =>  $fullname]);

            if ($affectedRows > 0) {

                return redirect()
                    ->route('get-customers')
                    ->with('success', 'Customer has successfully been updated!');
            } else {
                return redirect()
                    ->route('get-customers')
                    ->with('error', 'Customer failed to update!');
            }
        } catch (\Exception $e) {

            echo $e->getMessage();
        }
    }

    public function getProfile($id)
    {
        $account_number = Crypt::decrypt($id);
        $reservations      = Reservations::where('account_number', $account_number)->get();
        $bills         = Bill::where('account_number', $account_number)->get();
        $customers     = Customer::where('account_number', $account_number)->first();

        $images        = AttachDocuments::where('reference_number', $id)->orwhere('reservation_id', $account_number)->get();

        return view('customer.view', compact('customers','images', 'bills', 'reservations'));
    }


    public function deleteCustomer(Request $request)
    {


        if ($request->ID) {
            $ID = $request->ID;
            $affectedRows = Customer::where('id', '=', $ID)->delete();

            if ($affectedRows > 0) {
                $ini   = array('OK' => 'OK');
                return  Response::json($ini);
            } else {
                $ini   = array('No Data' => $ID);
                return  Response::json($ini);
            }
        } else {
            $ini   = array('No Data' => 'No Data');
            return  Response::json($ini);
        }
    }


    public function activateCustomer(Request $request)
    {
        $userid = $request->ID;

        $affectedRows = Customer::where('id', '=', $userid)->update(array('status' => 'Active'));

        if ($affectedRows > 0) {
            $ini = array('OK' => 'OK');
            return  Response::json($ini);
        } else {
            $ini = array('No Data' => 'No Data');
            return  Response::json($ini);
        }
    }


    public function deactivateCustomer(Request $request)
    {
        $userid = $request->ID;

        $affectedRows = Customer::where('id', '=', $userid)->update(array('status' => 'Deactive'));

        if ($affectedRows > 0) {
            $ini = array('OK' => 'OK');
            return  Response::json($ini);
        } else {
            $ini = array('No Data' => 'No Data');
            return  Response::json($ini);
        }
    }

    
    public function getAgencyPolicies($id)
    {

        $id = Crypt::decrypt($id);

        //dd($id);

        $reservations       = Reservations::where('agency', $id)->orderby('fullname', 'asc')->get();

        //dd($policies);

        $bills          = Bill::where('agency', $id)->get();
        $agent      = Agent::where('agentcode', $id)->first();
        $images         = AttachDocuments::where('reference_number', $id)->get();


        return view('agents.profile', compact('images', 'agent', 'bills', 'reservations'));
    }

    public function addCustomerNote(Request $request){
        $comment = new DocComments;

        $comment->doc_type = 'Customer Notes';
        $comment->doc_number = $request->account_id;
        $comment->comment = $request->customer_note;
        $comment->created_by = Auth::user()->getNameOrUsername();
		$comment->created_on = Carbon::now();

        $accountnumber = Crypt::encrypt($request->account_id);
        if ($comment->save()) {

            return redirect()
                ->route('customer-profile',$accountnumber)
                ->with('success', 'Note has successfully been added!');
        } else {
            return redirect()
                ->route('customer-profile',$accountnumber)
                ->with('error', 'Failed to add note!');
        }

    }




}
