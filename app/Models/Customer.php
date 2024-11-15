<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hashids;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Kyslik\ColumnSortable\Sortable;
use OwenIt\Auditing\Contracts\Auditable;
//use Laravel\Scout\Searchable;



class Customer extends Model implements Auditable
{
	

	//use Sortable;
	use SoftDeletes;
  use \OwenIt\Auditing\Auditable;




    protected $table = 'customer_new';
    //protected $table = 'customer_new_priority';
    public $timestamps = false;
    
    protected $casts = [
      'date_of_birth' => 'datetime'
    ];

    protected $fillable = ['account_type',
                           'fullname',
                           'first_name',
                           'last_name',
                           'account_manager',
                           'residential_address', 
                           'postal_address', 
                           'email', 
                           'mobile_number',
                           'mobile_number_2',
                           'mobile_number_3', 
                           'field_of_activity',
                           'date_of_birth',
                           'sales_channel',
                           'gender'];

    protected $auditInclude = ['fullname','mobile_number','account_type','residential_address','postal_address','email','sale_channel','account_manager','created_by'];
  

}
