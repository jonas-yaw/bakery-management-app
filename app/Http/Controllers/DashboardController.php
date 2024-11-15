<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reservations;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('password.expires');
    }

    public function getOccupancyStatistics(){
        $total_in_house_guests = 0;
        $total_arrivals = 0;

        $total_in_house_guests = Reservations::where('status','Checked-in')->count();
        $total_arrivals = Reservations::where('status','Checked-in')
        ->whereDate('from_date',Carbon::now())
        ->count();

        $added_response = array(
            'total_in_house_guests' => number_format($total_in_house_guests , 2, '.', ','),
            'total_arrivals' => number_format($total_arrivals , 2, '.', ',')
        );
        
        return  Response::json( $added_response);
    }
}
