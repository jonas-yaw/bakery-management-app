<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Payments;
use Livewire\WithPagination;
use App\Exports\PaymentsExport;

class PaymentListToday extends Component
{
    use WithPagination;

    public $paginate = 20;
    public $paymentsInPage = [], $allPayments = [];

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
        $this->allPayments = $this->paymentsQuery->pluck('id')->toArray();
        $this->paymentsInPage = $this->payments->pluck('id')->toArray();
    }

    public function setPaginate($value)
    {
        $this->paginate = $value;
    }

    public function deleteRecord($checkedItems)
    {
        Payments::whereIn('id', $checkedItems)->delete();
        session()->flash('message', 'Records deleted successfully.');
    }

    public function getPaymentsQueryProperty(){
        return Payments::orderBy($this->sortField,$this->sortDirection)
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

    public function getPaymentsProperty(){
        return $this->paymentsQuery->paginate($this->paginate);
    }
    
    public function exportSelected(array $checked){
        return (new PaymentsExport($checked))->download(fileName: now().' - payments-list.xlsx');
    }

    public function updatedPaginate(){
        $this->paymentsInPage = $this->payments->pluck('id')->toArray();
    }

    public function changeSortDirection()
    {
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        $this->paymentsInPage = $this->payments->pluck('id')->toArray();
    }

    public function changeSortField($sortField,$sortFieldName)
    {
        if ($this->sortField <> $sortField) {
            $this->sortField = $sortField;
            $this->sortFieldName = $sortFieldName;
            
        }
        $this->paymentsInPage = $this->payments->pluck('id')->toArray();
    }

    public function render()
    {
        $payments = $this->payments;
        return view('livewire.payment-list-today',compact('payments'));
    }
}
