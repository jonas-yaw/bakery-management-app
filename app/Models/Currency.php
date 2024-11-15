<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    Use SoftDeletes;

    protected $table = 'currencies';
    public $timestamps = false;
}

