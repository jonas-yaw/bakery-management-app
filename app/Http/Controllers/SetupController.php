<?php

namespace App\Http\Controllers;

use DB;

use Auth;
use Crypt;

use Input;
use Response;
use Validator;
use Carbon\Carbon;
use App\Models\Hall;
use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use App\Models\Floor;
use App\Models\Taxes;
use App\Http\Requests;
use App\Models\Branch;
use App\Models\Brands;
use App\Models\Coupon;
use App\Models\ApiUser;
use App\Models\Company;
use App\Models\Campaign;
use App\Models\Currency;
use App\Models\Discount;
use App\Models\HallType;
use App\Models\Insurers;
use App\Models\Amenities;
use App\Models\RoomTypes;
use App\Models\Workgroup;
use App\Models\Categories;
use App\Models\Permission;
use App\Models\Profession;
use App\Models\RoomStatus;
use App\Models\Beneficiary;
use App\Models\PaymentType;
use App\Models\VehicleMake;
use App\Imports\FleetImport;
use App\Models\BondTemplate;
use App\Models\HouseKeepers;
use App\Models\Intermediary;
use App\Models\NatureofLoss;
use App\Models\PropertyType;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use App\Models\PolicyClauses;
use App\Models\PolicyRiskType;
use App\Models\EndorsementText;
use App\Models\TransactionType;
use App\Models\MortgageCompanies;
use App\Models\PolicyProductType;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Bmatovu\MtnMomo\Products\Collection;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;


class SetupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public $messages = [
        'required' => ':attribute is required.',
        'digits' => ':attribute must be exactly :size digits.',
        'numeric' => ':attribute must be a number.',
        'unique' => ':attribute already exists',
        'string' => ':attribute must be a string',
        'min' => ':attribute must not be less than :value characters',
        'max' => ':attribute must not be more than :value characters',
        'between' => ':attribute value :input is not between :min - :max.',
        'in' => 'The :attribute must be one of the following types: :values'
    ];

    public function getUsers()
    {
        $roles = Role::get();
        $branches = Branch::orderby('branch_name', 'asc')->get();
        $permissions = DB::table("permissions")->get();
        $users =  User::paginate(30);
        $userslist = User::get('fullname');
        return view('auth.user', compact('userslist','branches','users', 'permissions', 'roles'));
    }

    public function index()
    {
        $brands = Brands::get();
        $categories = Categories::get();
        $payment_modes = PaymentType::get();

        return view('setup.index',compact('brands','categories','payment_modes'));
    }


    //store 
    public function addBrandType(Request $request){
        $brand = new Brands;
        $brand->type = \strtoupper($request->brand_type);
        $brand->created_on = Carbon::now();
        $brand->created_by = Auth::user()->getNameOrUsername();

        if($brand->save()){
            return redirect()
            ->route('setup')
            ->with('success','Brand type added successfully!');
        }else{
            return redirect()
            ->route('setup')
            ->with('error','Failed to add brand type');
        }
    }

    public function fetchBrandDetails(Request $request){
        try {
            $id = $request->id;
            $item = Brands::find($id);
            $data = array(
                'id' => $item->id,
                'type' => $item->type,
            );
            return  Response::json($data);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateBrandType(Request $request){
        try {
            $affectedRows = Brands::find($request->id)->update([
                'type' => \strtoupper($request->brand_type)
            ]);

            if($affectedRows > 0){
                return redirect()
                ->route('setup')
                ->with('success','Brand updated successfully!');
            }else{
                return redirect()
                ->route('setup')
                ->with('error','Failed to update brand type');
            }
        } catch (\Exception $e) {

            echo $e->getMessage();
        }
    }

    public function deleteBrandType(Request $request){
        if ($request->ID) {
            $ID = $request->ID;
            $affectedRows = Brands::where('id', $ID)->delete();
            if ($affectedRows > 0) {
                $data = array('status' => 'success');
            } else {
                $data = array('status' => 'failed');
            }
        } else {
            $data = array('status' => 'failed');
        }

        return  Response::json($data);
    }




    public function addCategoryType(Request $request){
        $brand = new Categories;
        $brand->type = \strtoupper($request->type);
        $brand->created_on = Carbon::now();
        $brand->created_by = Auth::user()->getNameOrUsername();

        if($brand->save()){
            return redirect()
            ->route('setup')
            ->with('success','Category added successfully!');
        }else{
            return redirect()
            ->route('setup')
            ->with('error','Failed to add category');
        }
    }

    public function fetchCategoryDetails(Request $request){
        try {
            $id = $request->id;
            $item = Categories::find($id);
            $data = array(
                'id' => $item->id,
                'type' => $item->type,
            );
            return  Response::json($data);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateCategoryType(Request $request){
        try {
            $affectedRows = Categories::find($request->id)->update([
                'type' => \strtoupper($request->type)
            ]);

            if($affectedRows > 0){
                return redirect()
                ->route('setup')
                ->with('success','Category updated successfully!');
            }else{
                return redirect()
                ->route('setup')
                ->with('error','Failed to update category');
            }
        } catch (\Exception $e) {

            echo $e->getMessage();
        }
    }

    public function deleteCategoryType(Request $request){
        if ($request->ID) {
            $ID = $request->ID;
            $affectedRows = Categories::where('id', $ID)->delete();
            if ($affectedRows > 0) {
                $data = array('status' => 'success');
            } else {
                $data = array('status' => 'failed');
            }
        } else {
            $data = array('status' => 'failed');
        }

        return  Response::json($data);
    }


    public function addPaymentType(Request $request){
        $brand = new PaymentType;
        $brand->type = \strtoupper($request->type);
        $brand->created_on = Carbon::now();
        $brand->created_by = Auth::user()->getNameOrUsername();

        if($brand->save()){
            return redirect()
            ->route('setup')
            ->with('success','Payment type added successfully!');
        }else{
            return redirect()
            ->route('setup')
            ->with('error','Failed to add payment type');
        }
    }

    public function fetchPaymentDetails(Request $request){
        try {
            $id = $request->id;
            $item = PaymentType::find($id);
            $data = array(
                'id' => $item->id,
                'type' => $item->type,
            );
            return  Response::json($data);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updatePaymentType(Request $request){
        try {
            $affectedRows = PaymentType::find($request->id)->update([
                'type' => \strtoupper($request->type)
            ]);

            if($affectedRows > 0){
                return redirect()
                ->route('setup')
                ->with('success','Payment Mode updated successfully!');
            }else{
                return redirect()
                ->route('setup')
                ->with('error','Failed to update payment mode');
            }
        } catch (\Exception $e) {

            echo $e->getMessage();
        }
    }

    public function deletePaymentType(Request $request){
        if ($request->ID) {
            $ID = $request->ID;
            $affectedRows = PaymentType::where('id', $ID)->delete();
            if ($affectedRows > 0) {
                $data = array('status' => 'success');
            } else {
                $data = array('status' => 'failed');
            }
        } else {
            $data = array('status' => 'failed');
        }

        return  Response::json($data);
    }


}

