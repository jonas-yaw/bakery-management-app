<?php

namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class StockExport implements FromQuery
{
    use Exportable;
    protected $items;

    public function __construct($items){
        $this->items = $items;
    }

    public function query()
    {
        return Stock::query()->whereKey($this->items);
    }
}
