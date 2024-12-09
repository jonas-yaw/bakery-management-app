<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

#---------------------------- Auth Controller ---------------------------#
Auth::routes();

Route::get('/',
	['uses' => '\App\Http\Controllers\AuthController@getSignin',
	 'as' => 'auth.signin',
]);


Route::post('/signin',
	['uses' => '\App\Http\Controllers\AuthController@postSignin',
]);

Route::get('/login',
	['uses' => '\App\Http\Controllers\AuthController@getSignin',
	 'as' => 'login',
]);

Route::get('/find-user',
	['uses' => '\App\Http\Controllers\AuthController@searchUser',
	 'as' => 'find-user',
]);

Route::get('/reset-password-notice',
	['uses' => '\App\Http\Controllers\AuthController@resetnotice',
	 'as' => 'reset-password-notice', ]);


     Route::post('/update-user',
	['uses' => '\App\Http\Controllers\AuthController@resetPassword',]);


Route::get('/edit-user/{id}',
['uses' => '\App\Http\Controllers\AuthController@getUserEdit',
 'as' => 'edit-user', ]);

 Route::get('/delete-user',
	[
		'middleware' => ['permission:delete-user'],
		'uses' => '\App\Http\Controllers\AuthController@deleteUser',
	 'as' => 'delete-user', ]);

     Route::post('/signup',
	['uses' => '\App\Http\Controllers\AuthController@postSignup', 'as' => 'auth.signup',]);

    Route::get('/signin',
	['uses' => '\App\Http\Controllers\AuthController@getSignin',
	 'as' => 'auth.signin', ]);

Route::post('/signin',
	['uses' => '\App\Http\Controllers\AuthController@postSignin',

	 ]);

Route::get('/signout', function(){
        Auth::logout(); //logout the current user
        Session::flush(); //delete the session
        return Redirect::to('login'); //redirect to login page
      });
      


//Permissions and role
Route::get('/create-role', [
	'middleware' => ['permission:add-new-role'],
	'uses' => '\App\Http\Controllers\AuthController@getCreateRole','as' => 'create-role',]);
Route::post('/create-new-role', [
	'middleware' => ['permission:add-new-role'],
	'uses' => '\App\Http\Controllers\AuthController@createNewRole','as' => 'create-new-role',]);
Route::post('/update-role/{id}', [
	'middleware' => ['permission:edit-role'],
	'uses' => '\App\Http\Controllers\AuthController@updateRole','as' => 'update-role',]);
Route::get('/delete-role', [
	'middleware' => ['permission:delete-role'],
	'uses' => '\App\Http\Controllers\AuthController@destroyRole','as' => 'delete-role',]);
Route::get('/edit-role/{id}', [
	'middleware' => ['permission:edit-role'],
	'uses' => '\App\Http\Controllers\AuthController@getEditRole','as' => 'edit-role',]);

//Limits
Route::get('/get-role-limits', ['uses' => '\App\Http\Controllers\AuthController@getRoleLimits','as' => 'get-role-limits',]);
Route::get('/delete-limit', ['uses' => '\App\Http\Controllers\AuthController@deleteLimit','as' => 'delete-limit',]);
Route::get('/edit-limit-detail', ['uses' => '\App\Http\Controllers\AuthController@editLimit','as' => 'edit-limit-detail',]);
Route::get('/add-role-limit', ['uses' => '\App\Http\Controllers\AuthController@addRoleLimits','as' => 'add-role-limit',]);


//Dashboard 
Route::get('/dashboard',
['uses' => '\App\Http\Controllers\HomeController@index',
 'as' => 'dashboard',
  ]);

Route::get('/home',
['uses' => '\App\Http\Controllers\HomeController@getHomePage',
'as' => 'home',
]);


#---------------------------- Invoice Controller ---------------------------#

Route::get('/day-exchange-rates',
	['uses' => '\App\Http\Controllers\InvoiceController@exchangeRates',
	'as' => 'day-exchange-rates', ]);


Route::get('/get-invoices',
	['uses' => '\App\Http\Controllers\InvoiceController@getInvoices',
	'as' => 'get-invoices', ]);
	
Route::get('/get-payments',
	['uses' => '\App\Http\Controllers\InvoiceController@getPayments',
	'as' => 'get-payments', ]);

Route::get('/print-invoice/{id}',
	['uses' => '\App\Http\Controllers\InvoiceController@printInvoice',
	 'as' => '/print-invoice', ]);

Route::get('/make-payment/{id}',
	['uses' => '\App\Http\Controllers\InvoiceController@makePayment',
	 'as' => 'make-payment', ]);

Route::get('/do-payment',
	 ['uses' => '\App\Http\Controllers\InvoiceController@doPayment',
	  'as' => '/do-payment', ]);


Route::get('/print-receipt/{id}',
	['uses' => '\App\Http\Controllers\InvoiceController@printReceipt',
	 'as' => '/print-receipt', ]);
#---------------------------- Setup Controller ---------------------------#
Route::get('/manage-users',
[
    'middleware' => ['permission:view-users'],
    'uses' => '\App\Http\Controllers\SetupController@getUsers',
    'as' => 'manage-users', ]);


//Setting up
Route::get('/setup',
	['uses' => '\App\Http\Controllers\SetupController@index',
	 'as' => 'setup', ]);

Route::post('/update-company-details',
        ['uses' => '\App\Http\Controllers\SetupController@updateCompanyDetails',]);

Route::post('/add-new-brand',
	['uses' => '\App\Http\Controllers\SetupController@addBrandType',]);

Route::get('/fetch-brand-details',
    ['uses' => '\App\Http\Controllers\SetupController@fetchBrandDetails',]);

Route::post('/edit-brand',
	['uses' => '\App\Http\Controllers\SetupController@updateBrandType',]);

Route::get('/delete-brand-type',
    ['uses' => '\App\Http\Controllers\SetupController@deleteBrandType',]);


Route::post('/add-new-category',
	['uses' => '\App\Http\Controllers\SetupController@addCategoryType',]);

Route::get('/fetch-category-details',
	['uses' => '\App\Http\Controllers\SetupController@fetchCategoryDetails',]);

Route::post('/edit-category',
	['uses' => '\App\Http\Controllers\SetupController@updateCategoryType',]);

Route::get('/delete-category-type',
		['uses' => '\App\Http\Controllers\SetupController@deleteCategoryType',]);

Route::post('/add-new-payment-type',
	['uses' => '\App\Http\Controllers\SetupController@addPaymentType',]);

Route::get('/fetch-payment-type-details',
	['uses' => '\App\Http\Controllers\SetupController@fetchPaymentDetails',]);

Route::post('/edit-payment-type',
	['uses' => '\App\Http\Controllers\SetupController@updatePaymentType',]);

Route::get('/delete-payment-type',
		['uses' => '\App\Http\Controllers\SetupController@deletePaymentType',]);
	

#------------------KYC Controller ---------------------#
Route::get('/get-customers', 
['uses' => '\App\Http\Controllers\KYCController@getCustomers',
        'as' => 'get-customers',]);

Route::get('/find-customer',
['uses' => '\App\Http\Controllers\KYCController@getSearchResults',
'as' => 'find-customer', ]);

Route::get('/register-start',
['middleware' => ['permission:create-customer'],
'uses' => '\App\Http\Controllers\KYCController@registerCustomer',
        'as' => 'register-start', ]);

Route::get('/create-customer',
[
'middleware' => ['permission:create-customer'],
'uses' => '\App\Http\Controllers\KYCController@postNewCustomer',
'as' => 'create-customer',]);

Route::get('/load-customer-details',
['uses' => '\App\Http\Controllers\KYCController@loadCustomer',
'as' => 'load-customer-details',]);

Route::get('/customer-profile/{id}',
['uses' => '\App\Http\Controllers\KYCController@getProfile',
'as' => 'customer-profile',]);


Route::post('/merge-customer-number',
['uses' => '\App\Http\Controllers\KYCController@mergeCustomer',
'as' => 'merge-customer-number',]);

Route::get('/edit-customer',
[
        'middleware' => ['permission:edit-customer'],
        'uses' => '\App\Http\Controllers\KYCController@editCustomer',
'as' => 'edit-customer',]);

Route::post('/update-customer',
['uses' => '\App\Http\Controllers\KYCController@updateCustomer',
'as' => 'update-customer',]);

Route::get('/activate-customer', array(
	'uses' => '\App\Http\Controllers\KYCController@activateCustomer',
	'as' => 'activate-customer',
	));
        
Route::get('/deactivate-customer', array(
        'uses' => '\App\Http\Controllers\KYCController@deactivateCustomer',
        'as' => 'deactivate-customer',
        ));

Route::get('/delete-customer',
        ['uses' => '\App\Http\Controllers\KYCController@deleteCustomer',
        'as' => 'delete-customer',]);

Route::post('/add-customer-note',
		['uses' => '\App\Http\Controllers\KYCController@addCustomerNote',
		'as' => 'add-customer-note',]);




#----------------DASHBOARD 
Route::get('/get-occupancy-statistics',
['uses' => '\App\Http\Controllers\DashboardController@getOccupancyStatistics',
'as' => 'get-occupancy-statistics',]);


#----------------STOCK
Route::get('/get-stock', 
['uses' => '\App\Http\Controllers\StockController@index',
        'as' => 'get-stock',]);

Route::get('/get-catalogue', 
['uses' => '\App\Http\Controllers\StockController@getCatalogue',
        'as' => 'get-catalogue',]);

Route::get('/add-item-to-cart', 
['uses' => '\App\Http\Controllers\StockController@addItemToCart',
		'as' => 'add-item-to-cart',]);

Route::get('/create-sale', 
['uses' => '\App\Http\Controllers\StockController@getCartItems',
		'as' => 'create-sale',]);

Route::post('/do-checkout', 
['uses' => '\App\Http\Controllers\StockController@doCheckout',
		'as' => 'do-checkout',]);

Route::get('/fetch-stock-item-details', 
['uses' => '\App\Http\Controllers\StockController@fetchStockItemDetails',
		'as' => 'fetch-stock-item-details',]);


Route::get('/find-stock-item', 
['uses' => '\App\Http\Controllers\StockController@findStockItem',
		'as' => 'find-stock-item',]);

Route::get('/find-stock-item-regex', 
['uses' => '\App\Http\Controllers\StockController@findStockItemRegex',
		'as' => 'find-stock-item-regex',]);


Route::post('/add-stock-item', 
['uses' => '\App\Http\Controllers\StockController@addStockItem',
		'as' => 'add-stock-item',]);

Route::post('/update-stock-item', 
['uses' => '\App\Http\Controllers\StockController@updateStockItem',
		'as' => 'update-stock-item',]);

Route::get('/add-stock-item-page', 
['uses' => '\App\Http\Controllers\StockController@addStockItemPage',
		'as' => 'add-stock-item-page',]);
		
Route::get('/get-stock-item-detail/{id}', 
['uses' => '\App\Http\Controllers\StockController@getStockItemDetail',
		'as' => 'get-stock-item-detail',]);
#----------------REPORTS
Route::get('/get-reports', 
['uses' => '\App\Http\Controllers\ReportsController@index',
		'as' => 'get-reports',]);

Route::get('/get-daily-sales-report', 
['uses' => '\App\Http\Controllers\ReportsController@getDailySalesReport',
		'as' => 'get-daily-sales-report',]);

Route::get('/filter-daily-sales-report', 
['uses' => '\App\Http\Controllers\ReportsController@filterDailySalesReport',
		'as' => 'filter-daily-sales-report',]);

Route::get('/get-profit-and-loss-report', 
['uses' => '\App\Http\Controllers\ReportsController@getProfitAndLossReport',
		'as' => 'get-profit-and-loss-report',]);

Route::get('/filter-profit-and-loss-report', 
['uses' => '\App\Http\Controllers\ReportsController@filterProfitAndLossReport',
		'as' => 'filter-profit-and-loss-report',]);

Route::get('/get-stock-report', 
['uses' => '\App\Http\Controllers\ReportsController@getStockReport',
	'as' => 'get-stock-report',]);


Route::get('/get-suppliers-report', 
['uses' => '\App\Http\Controllers\ReportsController@getSuppliersReport',
	'as' => 'get-suppliers-report',]);

Route::get('/get-customers-report', 
['uses' => '\App\Http\Controllers\ReportsController@getCustomersReport',
	'as' => 'get-customers-report',]);


#-----------------SUPPLIERS 
Route::get('/get-suppliers', 
['uses' => '\App\Http\Controllers\StockController@getSuppliers',
		'as' => 'get-suppliers',]);

Route::post('/add-supplier', 
		['uses' => '\App\Http\Controllers\StockController@addSupplier',
		'as' => 'add-supplier',]);

Route::get('/fetch-supplier-details', 
		['uses' => '\App\Http\Controllers\StockController@fetchSupplierDetails',
		'as' => 'fetch-supplier-details',]);
		
Route::post('/edit-supplier', 
		['uses' => '\App\Http\Controllers\StockController@editSupplier',
		'as' => 'edit-supplier',]);

Route::get('/delete-supplier', 
		['uses' => '\App\Http\Controllers\StockController@deleteSupplier',
		'as' => 'delete-supplier',]);

#-----------------QUOTATION 
Route::get('/get-quotations', 
['uses' => '\App\Http\Controllers\InvoiceController@getQuotation',
		'as' => 'get-quotations',]);

Route::get('/add-quotation-page', 
['uses' => '\App\Http\Controllers\InvoiceController@getAddQuotationPage',
		'as' => 'add-quotation-page',]);

Route::get('/edit-quotation-page/{id}', 
['uses' => '\App\Http\Controllers\InvoiceController@getEditQuotationPage',
		'as' => 'edit-quotation-page',]);