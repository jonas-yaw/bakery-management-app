<?php

namespace App\Exports;

use App\Models\Customer;
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
        return Customer::query()->whereKey($this->items);
    }
}
