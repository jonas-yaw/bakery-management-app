<?php

namespace App\Exports;

use App\Models\Suppliers;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class SuppliersExport implements FromQuery
{
    use Exportable;
    protected $items;

    public function __construct($items){
        $this->items = $items;
    }

    public function query()
    {
        return Suppliers::query()->whereKey($this->items);
    }
}
