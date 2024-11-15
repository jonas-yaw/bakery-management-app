<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Stock;
use App\Models\Reports;
use App\Models\Payments;
use App\Models\Suppliers;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Models\StockCategory;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $reports = Reports::where('status','Active')->get();

        return view('reporting.index',compact('reports'));
    }

    public function getDailySalesReport(){
        $report = Reports::where('name','Daily Sales Report')->first();
        $paymentmodes = PaymentType::get();
        $stock_category = StockCategory::get();
        //$data = Payments::whereDate('receipt_date',Carbon::now()->format('Y-m-d'))->get();
        $data = DB::select('call sp_get_daily_sales_report("'.Carbon::now()->format('Y-m-d').'","'.Carbon::now()->format('Y-m-d').'","All","All" )');



        return view('reporting.daily_sales_report',compact('report','paymentmodes','stock_category','data'));
    }

    public function filterDailySalesReport(Request $request){
        $report = Reports::where('name','Daily Sales Report')->first();
        $paymentmodes = PaymentType::get();
        $stock_category = StockCategory::get();

        $filter_start_date = Carbon::createFromFormat('d/m/Y', $request->filter_start_date);
        $filter_end_date = Carbon::createFromFormat('d/m/Y', $request->filter_end_date);
        $collection_mode = $request->collection_mode;
        $product_category = $request->product_category;

        // Start building your query
        //$query = Payments::query();

        // Filter by category if a specific category is selected
     

        // Filter by collection mode if a specific mode is selected


        // Filter by date range if both start and end dates are provided
        if ($filter_start_date && $filter_end_date && ($product_category == 'All') && ($collection_mode == 'All')) {
            $data = DB::select('call sp_get_daily_sales_report("'.Carbon::now()->format('Y-m-d').'","'.Carbon::now()->format('Y-m-d').'","All","All" )');
        }else if ($product_category && $product_category !== 'All') {
            $query->where('category', $product_category); 
            $data = DB::select('call sp_get_daily_sales_report("'.Carbon::now()->format('Y-m-d').'","'.Carbon::now()->format('Y-m-d').'","All","'.$product_category.'" )');

        }else if ($collection_mode && $collection_mode !== 'All') {
            $query->where('collection_mode', $collection_mode); 
            $data = DB::select('call sp_get_daily_sales_report("'.Carbon::now()->format('Y-m-d').'","'.Carbon::now()->format('Y-m-d').'","All","',$collection_mode,'" )');
        }
        

        return view('reporting.daily_sales_report',compact('report','paymentmodes','stock_category','data'));
    }

    public function getProfitAndLossReport(){
        $report = Reports::where('name','Profit and Loss')->first();
        $data = DB::select('call sp_get_profit_and_loss("'.Carbon::now()->format('Y-m-d').'","'.Carbon::now()->format('Y-m-d').'" )');

        $total_cost_price = 0;
        $total_selling_price = 0;
        $total_profit_and_loss = 0;

        foreach ($data as $key => $item) {
            $total_cost_price += $item->total_cost_price;
            $total_selling_price += $item->total_selling_price;
            $total_profit_and_loss += $item->profit_and_loss;
        }

        return view('reporting.profit_and_loss',compact('report','data','total_cost_price','total_selling_price','total_profit_and_loss'));
    }


    public function filterProfitAndLossReport(Request $request){
        $filter_start_date = Carbon::createFromFormat('d/m/Y', $request->filter_start_date);
        $filter_end_date = Carbon::createFromFormat('d/m/Y', $request->filter_end_date);

        $report = Reports::where('name','Profit and Loss')->first();
        $data = DB::select('call sp_get_profit_and_loss("'.$filter_start_date->format('Y-m-d').'","'.$filter_end_date->format('Y-m-d').'" )');

        $total_cost_price = 0;
        $total_selling_price = 0;
        $total_profit_and_loss = 0;

        foreach ($data as $key => $item) {
            $total_cost_price += $item->total_cost_price;
            $total_selling_price += $item->total_selling_price;
            $total_profit_and_loss += $item->profit_and_loss;
        }

        return view('reporting.profit_and_loss',compact('report','data','total_cost_price','total_selling_price','total_profit_and_loss'));
    }



    public function getStockReport(){
        $report = Reports::where('name','Daily Sales Report')->first();
        $data = Stock::get();

        return view('reporting.stock_report',compact('report','data'));
    }

    public function getSuppliersReport(){
        $report = Reports::where('name','Daily Sales Report')->first();
        $data = Suppliers::get();

        return view('reporting.suppliers_report',compact('report','data'));
    }

    public function getCustomersReport(){
        $report = Reports::where('name','Daily Sales Report')->first();
        $data = Payments::select('customer_name','customer_mobile_number')
        ->whereNotNull('customer_mobile_number')
        ->groupBy('customer_name','customer_mobile_number')->get();

        return view('reporting.customers_report',compact('report','data'));
    }

}
