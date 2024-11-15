<?php

namespace App\Http\Controllers;

use Cache;
use Response;
use Carbon\Carbon;
use App\Models\Bank;
use App\Models\Bill;
use App\Models\User;
use App\Models\Agent;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Payments;
use App\Models\PaymentType;
use App\Models\ReceiptType;
use App\Models\ExchangeRate;
use App\Models\JournalTypes;
use Illuminate\Http\Request;
use App\Models\ChartofAccount;
use NumberToWords\NumberToWords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function exchangeRates()
    {
        $items = ExchangeRate::orderby('type', 'asc')->paginate();
        return view('invoices.exchangerate', compact('items'));
    }

    public function generateInvoiceNumber(){
        $getbranchcode = Branch::where('branch_name', Auth::user()->getBranch())->first();

        $code = $getbranchcode->branch_code;
        $myaccount = DB::select('call gen_debit_number("' . $code . '")')[0]->MYID;

        return  $myaccount;
    }


    public function generateReceiptNumber(){
        $getbranchcode = Branch::where('branch_name', Auth::user()->getBranch())->first();

        $code = $getbranchcode->branch_code;
        $myaccount = DB::select('call gen_receipt_number("' . $code . '")');

        return  $myaccount[0]->MYID;
    }

    public function getInvoices(){
        $bills        =  Bill::where('payment_status', '<>', 'Paid')->where('amount', '>', 0)->where('branch', Auth::user()->getBranch())->orderBy('invoice_date', 'desc')->paginate(30);

        return view('invoices.bills', compact('bills'));
    }

    public function getPayments(Request $request){
        $query1 = Payments::query();
        $query2 = Payments::query();

        if($request->search){
            $query1->where('receipt_number',$request->search)
            ->orWhere('customer_name','like', '%'.$request->search.'%')
            ->orWhere('customer_mobile_number','like', '%'.$request->search.'%');

            $query2->where('receipt_number',$request->search)
            ->orWhere('customer_name','like', '%'.$request->search.'%')
            ->orWhere('customer_mobile_number','like', '%'.$request->search.'%');
        }

        //code adjusted to get todays and previous 
        $current_payments = $query1->select('receipt_number','receipt_date','debit_date','collection_mode','customer_name','customer_mobile_number', \DB::raw('SUM(sub_total_price) as total_amount'))
        ->whereDate('receipt_date',Carbon::now())
        ->where('created_by',Auth::user()->getNameOrUsername())
        ->groupBy('receipt_number','receipt_date','debit_date','collection_mode','customer_name','customer_mobile_number')
        ->orderBy('debit_date', 'desc')
        ->paginate(30);


        $previous_payments = $query2->select('receipt_number','receipt_date','debit_date','collection_mode','customer_name','customer_mobile_number', \DB::raw('SUM(sub_total_price) as total_amount'))
        ->whereDate('debit_date','<',Carbon::now())
        ->where('created_by',Auth::user()->getNameOrUsername())
        ->groupBy('receipt_number','receipt_date','debit_date','collection_mode','customer_name','customer_mobile_number')
        ->orderBy('debit_date', 'desc')
        ->paginate(30);

        /* $payments = $query->select('receipt_number','receipt_date','debit_date','collection_mode','customer_name','customer_mobile_number', \DB::raw('SUM(sub_total_price) as total_amount'))
            ->groupBy('receipt_number','receipt_date','debit_date','collection_mode','customer_name','customer_mobile_number')
            ->orderBy('debit_date', 'desc')
            ->paginate(30); 
        */


        return view('invoices.payment', compact( 'current_payments','previous_payments'));
    }

    public function printInvoice($id)
    {
        $customerid = Bill::where('id', '=', $id)->first();
       
        $bills      = Bill::where('invoice_number', $customerid->invoice_number)->first();
        //$bills      = Bill::where('invoice_number', $customerid->invoice_number)->where('flag','In Force')->first();

        $bills_total      = Bill::where('invoice_number', $customerid->invoice_number)->get();
        //$bills_total      = Bill::where('invoice_number', $customerid->invoice_number)->where('flag','In Force')->get();

        $signatureSup     = User::where('fullname', $bills->created_by)->first();

        $numberToWords = new NumberToWords();
        $currencyTransformer = $numberToWords->getCurrencyTransformer('en');
        $amountinwords =  $currencyTransformer->toWords(($bills_total->sum('amount')) * 100, $customerid->currency);
       
       
        $fleet_count = $bills_total->count();

        $remarks = '';

        return view('invoices.invoice_print', compact('remarks', 'bills', 'amountinwords', 'signatureSup','bills_total'));
    }



    public function makePayment($id)
    {

        $paymenttypes = PaymentType::all();
        $receipttypes = ReceiptType::all();


        if (Auth::user()->getNameOrUsername()) {
            $activity = Bill::firstOrNew(["id" => $id]);
            if ($activity->is_editing && $activity->editing_by != Auth::user()->getNameOrUsername() && $activity->editing_time->diffInMinutes(Carbon::now()) < 1)
                abort(402, $activity->editing_by . ' has locked this for payment. You cannot make payment on this debit until it is released by cashier!');
            else {
                $activity->is_editing = true;
                $activity->editing_by = Auth::user()->getNameOrUsername();
                $activity->editing_time = Carbon::now();
                $activity->save();
            }
        }

        $billindex = Bill::where('id', $id)->first();

        $bills   = Bill::where('invoice_number', $billindex->invoice_number)->get();
        $customer = Customer::where('account_number', $billindex->account_number)->first();
        $payments = Payments::where('invoice_number', $billindex->invoice_number)->get();

        $total_bills   = 0;
        $total_payment = 0;

        foreach ($bills as $payable) {
            $total_bills += $payable->amount;
        }

        foreach ($payments as $paid) {
            if ($paid->currency == $paid->debit_currency) {
                $total_payment += $paid->amount_paid;
            } else {
                $total_payment += $paid->forex_amount;
            }
        }

        $outstanding = $total_bills - $total_payment;

        $exchange = ExchangeRate::where('type', $billindex->currency)->first();

        $exchange_available = ExchangeRate::get();
        $agency   = Agent::where('agentcode', $billindex->agency)->first();

        $coa_banks  = ChartofAccount::whereIn('category', ['Bank Accounts','Cash Accounts','Fac Inward Commission','Fac Outward Commission'])->get();
        $banks = Bank::whereNotNull('prefix')->orderBy('name', 'asc')->get();

        return view('invoices.pay', compact('bills', 'banks', 'coa_banks', 'exchange_available', 'agency', 'paymenttypes', 'exchange', 'billindex', 'receipttypes', 'customer', 'payments', 'outstanding'));
    }

    public function printReceipt($id)
    {
        $id = Crypt::decrypt($id);

        $payments = Payments::where('receipt_number',$id)->get();
        $total_price = 0;

        foreach($payments as $payment){
            $total_price += $payment->sub_total_price;
        }
        $total_price += $payments[0]->delivery_fee + $payments[0]->discount;
        
      


        return view('invoices.receipt', compact( 'payments','total_price'));
    }


    public function doPayment(Request $request)
    {
        $accountmyval = floatval(preg_replace("/[^-0-9\.]/", "", $request->input('amountreceived')));

        if ($accountmyval != 0) {

            if($request->get('receipt_type') == 'Journal Offset')
            {
                $receiptnumber = $this->generateJournalNumberExtra(10);
            }
            else
            {
                $receiptnumber = $this->generateReceiptNumber();
            }
            


            $gross_commission = 0;
            $amount_currency    = 'GH¢';
            $forexamount = 0;
            $overpayment = 0;
            $amountpayable  = 0;

            $id              = $request->input('billid');
            $billdetails     = Bill::where('id', $id)->first();

            $bills_count     = Bill::where('invoice_number', $request->input('invoice_number'))->get()->count();
           
            $agent           = Agent::where('agentcode', $billdetails->agency)->FirstorFail();

            if ($billdetails->currency != $request->input("mycurrency")) {
                $amountpaid         = floatval(preg_replace("/[^-0-9\.]/", "", $request->input('amountreceived')));
                $forexamount        = floatval(preg_replace("/[^-0-9\.]/", "", $request->input('amountreceived'))) / ($request->input("exchange_rate") / $request->input("applied_exchange"));
                $amountpayable      = $request->input('payable') * ($request->input("exchange_rate") / $request->input("applied_exchange"));
                $amount_currency    = $request->input("mycurrency");
            } else {
                $amountpaid         = floatval(preg_replace("/[^-0-9\.]/", "", $request->input('amountreceived')));
                $amountpayable      = $request->input('payable');
                $amount_currency    = $billdetails->currency;
                $forexamount        = $amountpaid;
            }

            $payratio =  abs($amountpaid / $amountpayable);

            $amounttoprocesscommission = 0;
            if ($amountpaid <= $amountpayable) {
                $amounttoprocesscommission = $amountpaid;
                $overpayment = 0;
            } else {
                $overpayment = $amountpaid   -  $amountpayable;
                $amountpaid  =  $amountpaid  - $overpayment;
                $amounttoprocesscommission = $amountpaid;
            }

            $numberToWords = new NumberToWords();
            $currencyTransformer = $numberToWords->getCurrencyTransformer('en');
            $amountinwords =  $currencyTransformer->toWords($accountmyval * 100, $amount_currency);


            $chart_of_accounts_var = ChartofAccount::where('code', $request->input("coa_bank"))->first();
            $coa_name = '';
            if($chart_of_accounts_var){
                $coa_name = $chart_of_accounts_var->account;
            }

            $payments                   = new Payments();
            $payments->receipt_type     = $request->get('receipt_type');
            $payments->receipt_number   = $receiptnumber;
            $payments->invoice_number   = $billdetails->invoice_number;
            $payments->receipt_date     = Carbon::now();
            $payments->debit_date       = $billdetails->invoice_date;
            $payments->currency         = $amount_currency;
            $payments->amount_payable   = $amountpayable;
            $payments->amount_paid      = $accountmyval;
            $payments->over_payment     = $overpayment;
            $payments->forex_amount     = $forexamount;
            $payments->collection_mode  = $request->get('paymentmethod');
            
            if ($request->get('paymentmethod') == 'Cheque' || $request->get('paymentmethod') == 'Post Dated Cheque' || $request->get('paymentmethod') ==  'Self Cheque Deposit') {
                $payments->reference_number = $request->get('cheque_bank') . '-' . $request->get('chequenumber');
            } else {
                $payments->reference_number =  $request->get('referencenumber');
            }

            $payments->paid_by          = $request->get('fullname_paid');
            $payments->branch           = $billdetails->branch;
            $payments->cover_type       = 'Receipt';
            $payments->transaction_type = $billdetails->transaction_type;

            $payments->created_on       = Carbon::now();
            $payments->created_by       = Auth::user()->getNameOrUsername();
            $payments->amount_in_words  = ucwords(strtolower($amountinwords));

            $payments->reference           = $billdetails->reference;
            $payments->commence_date       = $billdetails->commence_date;
            $payments->expiry_date         = $billdetails->expiry_date;
            $payments->invoice_source      = $billdetails->invoice_source;
            $payments->agency              = $billdetails->agency;
            $payments->agent_name          = $agent->agentname;
            
            $payments->product          = $billdetails->product;
            $payments->account_number   = $billdetails->account_number;
            $payments->customer_name    = $billdetails->fullname;
            $payments->exchange_rate    = $request->input("exchange_rate"); 
            $payments->commission_rate  = $billdetails->commission_rate;

            $payments->bank_account_code  = $request->input("coa_bank");
            $payments->bank_account_name  = $coa_name;
            $payments->commission_pay_source  = $request->input("deduction_amount");
            $payments->debit_currency   = $billdetails->currency;
            if($request->input("deduction_amount") > 0){
                $payments->commission_status  = 'Processed';
            }

            if ($request->get('paymentmethod') == "Post Dated Cheque") {
                $payments->post_dated_date = Carbon::createFromFormat('d/m/Y', $request->get('paid_date'));
            }

            $payments->narration = $request->input("narration");
            $payments->ip_address = $request->ip();
            $payments->hostname = getHostName();

            if ($payments->save()) {
                //$this->processCommissiononPayment($payments->id);

                if (Company::first()->accounting == 1) {
                    $this->writeToLedger($payments->id,$payments->transaction_type);
                }

                if (($accountmyval+$request->input("deduction_amount")) < $amountpayable) {

                    $affectedRows = Bill::where('invoice_number', $billdetails->invoice_number)->update(array('payment_status' => 'Partially Paid')); 
                    $added_response = array('OK' => 'OK', 'ReferenceNumber' => $payments->id);
                    return  Response::json($added_response);
                } else {
                    $affectedRows = Bill::where('invoice_number', $billdetails->invoice_number)
                        ->update(array(
                            'payment_status' => 'Paid'
                    ));

                    $added_response = array('OK' => 'OK', 'ReferenceNumber' => $payments->id);
                    return  Response::json($added_response);
                }
            }
        } else {

            $ini = array('No Data' => 'No Data');
            return  Response::json($ini);
        }
    }






}
