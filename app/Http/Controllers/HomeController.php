<?php

namespace App\Http\Controllers;

use DB;

use Auth;
use Cache;
use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Event;
use App\Http\Requests;
use App\Models\Policy;
use App\Models\Customer;
use App\Models\Payments;
use Illuminate\Http\Request;
use App\Models\ProcessedPolicy;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('password.expires');
    }


    public function documentation()
    {
      return view('setup.documentation');
    }

    public function index()
    {
      $current_date = Carbon::now();
      $today_sales = Payments::whereDate('receipt_date',Carbon::now()->format('Y-m-d'))->sum('amount_paid');
      $today_earnings = DB::select('call sp_get_current_day_earning("'.Carbon::now()->format('Y-m-d').'")')[0]->profit_and_loss ?? 0;

      $visitors = Payments::select('customer_mobile_number')
      ->whereDate('receipt_date',Carbon::now()->format('Y-m-d'))
      ->groupby('customer_mobile_number')->count();
      $orders = Payments::whereDate('receipt_date',Carbon::now()->format('Y-m-d'))->sum('quantity');

      $weekly_data = DB::select('call sp_get_weekly_dashboard_trend("'.Carbon::now()->format('Y-m-d').'")');
      $weekly_array = array_fill(0, 7, 0);
      //dd($weekly_data);
      foreach ($weekly_data as $key => $data) {
        $weekly_array[$data->weekday-1] = $data->amount_paid;
      }

      $monthly_data = DB::select('call sp_get_monthly_dashboard_trend("'.Carbon::now()->format('Y-m-d').'")');
      $monthly_array = array_fill(0, 12, 0);
  
      foreach ($monthly_data as $key => $data) {
        $monthly_array[$data->monthnumber-1] = $data->amount_paid;
      }   

      $monthly_earning_data = DB::select('call sp_get_monthly_earning_dashboard("'.Carbon::now()->format('Y-m-d').'")');
      $monthly_earning_array = array_fill(0, 12, 0);
  
      foreach ($monthly_earning_data as $key => $data) {
        $monthly_earning_array[$data->monthnumber-1] = $data->profit_and_loss;
      }  

      return View('pages.dashboard',compact('today_sales','today_earnings','visitors','orders','weekly_array','monthly_array','monthly_earning_array'));
    }


    public function getHomePage()
    {
      $current_date = Carbon::now();
      $today_sales = Payments::whereDate('receipt_date',Carbon::now()->format('Y-m-d'))->sum('amount_paid');
      $monthly_sales = Payments::whereMonth('receipt_date',Carbon::now()->month)->sum('amount_paid');

      //$today_earnings = DB::select('call sp_get_current_day_earning("'.Carbon::now()->format('Y-m-d').'")')[0]->profit_and_loss ?? 0;

      $visitors = Payments::select('customer_mobile_number')
      ->whereDate('receipt_date',Carbon::now()->format('Y-m-d'))
      ->groupby('customer_mobile_number')->count();
      $orders = Payments::whereDate('receipt_date',Carbon::now()->format('Y-m-d'))->sum('quantity');

      $weekly_data = DB::select('call sp_get_weekly_dashboard_trend("'.Carbon::now()->format('Y-m-d').'")');
      $weekly_array = array_fill(0, 7, 0);
      //dd($weekly_data);
      foreach ($weekly_data as $key => $data) {
        $weekly_array[$data->weekday-1] = $data->amount_paid;
      }

      $monthly_data = DB::select('call sp_get_monthly_dashboard_trend("'.Carbon::now()->format('Y-m-d').'")');
      $monthly_array = array_fill(0, 12, 0);
  
      foreach ($monthly_data as $key => $data) {
        $monthly_array[$data->monthnumber-1] = $data->amount_paid;
      }   

      $monthly_earning_data = DB::select('call sp_get_monthly_earning_dashboard("'.Carbon::now()->format('Y-m-d').'")');
      $monthly_earning_array = array_fill(0, 12, 0);
  
      foreach ($monthly_earning_data as $key => $data) {
        $monthly_earning_array[$data->monthnumber-1] = $data->profit_and_loss;
      }  

      return View('pages.homePage',compact('today_sales','monthly_sales','visitors','orders','weekly_array','monthly_array','monthly_earning_array'));
    }


}
