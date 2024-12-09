<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Quotation;
use Livewire\WithPagination;

class QuotationsListings extends Component
{
    use WithPagination;

    public $paginate = 20;
    public $quotationsInPage = [], $allQuotations = [];

    //filters 
    public $receiptNumberFilter = null;
    public $collectionModeFilter = null;
    public $productFilter = null;
    public $categoryFilter = null;

    public $createdOnFilter = null;
    public $createdByFilter = null;

    protected $updatesQueryString = ['paginate'];
    protected $listeners = ['deleteRecord','exportSelected'];

    public $sortField = 'created_on',$sortFieldName = 'Created On',$sortDirection = 'desc';

    public function mount()
    {
        $this->paginate = request()->query('paginate', $this->paginate);
        $this->allQuotations = $this->quotationsQuery->pluck('id')->toArray();
        $this->quotationsInPage = $this->quotations->pluck('id')->toArray();
    }

    public function setPaginate($value)
    {
        $this->paginate = $value;
    }

    public function deleteRecord($checkedItems)
    {
        Quotation::whereIn('id', $checkedItems)->delete();
        session()->flash('message', 'Records deleted successfully.');
    }

    public function getQuotationsQueryProperty(){
        return Quotation::orderBy($this->sortField,$this->sortDirection)
        ->when($this->receiptNumberFilter, function($query){
            $query->where('receipt_number','like','%'.trim($this->receiptNumberFilter).'%');
        })
        ->when($this->collectionModeFilter, function($query){
            $query->where('collection_mode','like','%'.trim($this->collectionModeFilter).'%');
        })
        ->when($this->categoryFilter, function($query){
            $query->where('category','like','%'.trim($this->categoryFilter).'%');
        })
        ->when($this->productFilter, function($query){
            $query->where('product','like','%'.trim($this->productFilter).'%');
        })
        ->when($this->createdOnFilter, function($query){
            $query->where('created_on','like','%'.trim($this->createdOnFilter).'%');
        })
        ->when($this->createdByFilter, function($query){
            $query->where('created_by','like','%'.trim($this->createdByFilter).'%');
        });
    }

    public function getQuotationsProperty(){
        return $this->quotationsQuery->paginate($this->paginate);
    }
    
    public function exportSelected(array $checked){
        return (new PaymentsExport($checked))->download(fileName: now().' - quotations-list.xlsx');
    }

    public function updatedPaginate(){
        $this->quotationsInPage = $this->quotations->pluck('id')->toArray();
    }

    public function changeSortDirection()
    {
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        $this->quotationsInPage = $this->quotations->pluck('id')->toArray();
    }

    public function changeSortField($sortField,$sortFieldName)
    {
        if ($this->sortField <> $sortField) {
            $this->sortField = $sortField;
            $this->sortFieldName = $sortFieldName;
            
        }
        $this->quotationsInPage = $this->quotations->pluck('id')->toArray();
    }
    
    public function render()
    {
        $quotations = $this->quotations;
        return view('livewire.quotations-listings',compact('quotations'));
    }
}
