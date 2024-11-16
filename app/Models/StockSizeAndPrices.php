<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockSizeAndPrices extends Model
{
    Use SoftDeletes;
    protected $table = 'tabStock_entry_sizes_and_prices';

    public $timestamps = false;
}
