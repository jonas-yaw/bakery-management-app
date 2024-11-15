<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    Use SoftDeletes;

    protected $table = 'professions';
    public $timestamps = false;
}

