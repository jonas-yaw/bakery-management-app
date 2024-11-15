<?php

namespace App\Providers;
use Auth;
use Carbon\Carbon;
use App\Models\OPD;
use App\Models\Company;

use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()

    {

        Paginator::useBootstrap();

        $mycompany = Company::get()->first();
        $company = $mycompany;
        view()->share('mycompany', $mycompany,$company);
        view()->share('company',$company);

    }
}
