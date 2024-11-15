<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
   Use SoftDeletes;
   protected $table = 'bills';
   public $timestamps = false;

   protected $casts = [
    'commence_date' => 'datetime',
    'expiry_date' => 'datetime',
    'deleted_at' => 'datetime',
    'editing_time' => 'datetime',
    'amountreceived' => 'float',
  ];

   protected $fillable = ['payment_status','erp_id','erp_exception','old_transaction_type'];

   public function Payments()
    {
        return $this->hasMany('App\Models\Payments','invoice_number','invoice_number');
    }

}
