<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    Use SoftDeletes;
    use HasFactory;

    protected $table = 'quotations';
    public $timestamps = false;
}
