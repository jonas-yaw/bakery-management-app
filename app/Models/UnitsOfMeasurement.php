<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitsOfMeasurement extends Model
{
    Use SoftDeletes;
    protected $table = 'units_of_measurement';
    public $timestamps = false;
}
