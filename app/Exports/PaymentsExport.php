<?php

namespace App\Exports;

use App\Models\Payments;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class PaymentsExport implements FromQuery
{
    use Exportable;
    protected $items;

    public function __construct($items){
        $this->items = $items;
    }

    public function query()
    {
        return Payments::query()->whereKey($this->items);
    }
}
