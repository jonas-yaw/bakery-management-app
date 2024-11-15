<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brands extends Model
{
    Use SoftDeletes;
    protected $table = 'tabStock_brands';
    protected $fillable = ['type'];


    public $timestamps = false;
}
