<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxes extends Model
{
	Use SoftDeletes;

    protected $table = 'taxes';
    public $timestamps = false;

}

