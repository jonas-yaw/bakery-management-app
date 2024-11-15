<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payments extends Model
{
	// use Sortable;
    protected $table = 'payments';
    protected $dates = ['receipt_date','created_on','period_from'];
    public $timestamps = false;
    protected $fillable = ['commission_status','erp_id','erp_exception','old_transaction_type'];


    public function Bill(){
      return $this->belongsTo('App\Models\Bill');
	  }

    protected $casts = [
      'receipt_date' => 'datetime:Y-m-d',
  ];


}



