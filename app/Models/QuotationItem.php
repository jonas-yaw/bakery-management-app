<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationItem extends Model
{
    Use SoftDeletes;
    use HasFactory;

    protected $table = 'quotation_items';
    public $timestamps = false;
}
