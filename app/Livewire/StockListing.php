<?php

namespace App\Livewire;

use App\Models\Stock;
use Livewire\Component;
use App\Exports\StockExport;
use Livewire\WithPagination;

class StockListing extends Component
{
    use WithPagination;

    public $paginate = 20;
    public $stockInPage = [], $allStock = [];

    //filters 
    public $codeFilter = null;
    public $nameFilter = null;
    public $brandFilter = null;
    public $categoryFilter = null;

    public $createdOnFilter = null;
    public $createdByFilter = null;

    protected $updatesQueryString = ['paginate'];
    protected $listeners = ['deleteRecord','exportSelected'];

    public $sortField = 'created_on',$sortFieldName = 'Created On',$sortDirection = 'desc';

    public function mount()
    {
        $this->paginate = request()->query('paginate', $this->paginate);
        $this->allStock = $this->stockQuery->pluck('id')->toArray();
        $this->stockInPage = $this->stock->pluck('id')->toArray();
    }

    public function setPaginate($value)
    {
        $this->paginate = $value;
    }

    public function deleteRecord($checkedItems)
    {
        Stock::whereIn('id', $checkedItems)->delete();
        session()->flash('message', 'Records deleted successfully.');
    }

    public function getStockQueryProperty(){
        return Stock::orderBy($this->sortField,$this->sortDirection)
        ->when($this->codeFilter, function($query){
            $query->where('code','like','%'.trim($this->codeFilter).'%');
        })
        ->when($this->nameFilter, function($query){
            $query->where('item','like','%'.trim($this->nameFilter).'%');
        })
        ->when($this->categoryFilter, function($query){
            $query->where('category','like','%'.trim($this->categoryFilter).'%');
        })
        ->when($this->brandFilter, function($query){
            $query->where('brand','like','%'.trim($this->brandFilter).'%');
        })
        ->when($this->createdOnFilter, function($query){
            $query->where('created_on','like','%'.trim($this->createdOnFilter).'%');
        })
        ->when($this->createdByFilter, function($query){
            $query->where('created_by','like','%'.trim($this->createdByFilter).'%');
        });
    }

    public function getStockProperty(){
        return $this->stockQuery->paginate($this->paginate);
    }
    
    public function exportSelected(array $checked){
        return (new StockExport($checked))->download(fileName: now().' - stock-list.xlsx');
    }

    public function updatedPaginate(){
        $this->stockInPage = $this->stock->pluck('id')->toArray();
    }

    public function changeSortDirection()
    {
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        $this->stockInPage = $this->stock->pluck('id')->toArray();
    }

    public function changeSortField($sortField,$sortFieldName)
    {
        if ($this->sortField <> $sortField) {
            $this->sortField = $sortField;
            $this->sortFieldName = $sortFieldName;
            
        }
        $this->stockInPage = $this->stock->pluck('id')->toArray();
    }

    public function render()
    {
        $stock = $this->stock;
        return view('livewire.stock-listing',compact('stock'));
    }
}
