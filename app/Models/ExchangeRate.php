<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangeRate extends Model
{
	Use SoftDeletes;
    protected $table = 'exchangerate_new';
    public $timestamps = false;
    protected $dates = ['deleted_at'];
}
