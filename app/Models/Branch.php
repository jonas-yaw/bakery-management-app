<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    Use SoftDeletes;

    protected $table = 'branch_setup';
    public $timestamps = false;
}

