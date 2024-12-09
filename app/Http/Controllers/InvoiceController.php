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
use App\Models\Quotation;
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

    public function getQuotation(){
        return view('invoices.quotations');
    }

    public function getAddQuotationPage(){
        return view('invoices.add_quotation');
    }

    public function getEditQuotationPage($id){
        $id = Crypt::decrypt($id);
        $quotation = Quotation::where('id',$id)->first();
        return view('invoices.edit_quotation',compact('quotation'));
    }
}
