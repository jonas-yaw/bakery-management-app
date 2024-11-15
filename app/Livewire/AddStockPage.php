<?php

namespace App\Livewire;

use App\Models\Brands;
use Livewire\Component;
use App\Models\Suppliers;
use App\Models\Categories;

class AddStockPage extends Component
{
    public $editStatus = false,$itemCategory,$itemName,$itemBrand,
    $itemSupplier,$itemQuantity,$itemRestockLimit,$itemCostPrice,$itemSellingPrice;

    public $rows = [];

    public function mount(){

        $this->rows = [
            [
                'loan_security_name' => '',
                'loan_security_quantity' => '',
                'loan_security_price' => '',
                'loan_security_amount' => ''
            ]
        ];
    }

    public function render()
    {
        $categories = Categories::get();
        $brands = Brands::get();
        $suppliers = Suppliers::get();
        
        return view('livewire.add-stock-page',[
            'categories' => $categories,
            'brands' => $brands,
            'suppliers' => $suppliers,
        ]);
    }
}
