<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
     protected $table = 'payment_type';
     protected $fillable = ['type'];
     public $timestamps = false;
}
