<?php

namespace App\Livewire;

use App\Models\Serials;
use Livewire\Component;
use App\Models\Suppliers;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use App\Exports\SuppliersExport;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SuppliersList extends Component
{
    use WithPagination;
    use LivewireAlert;
    
    public $paginate = 20;
    public $suppliersInPage = [], $allSuppliers = [];
    public $supplierFirstName,$supplierLastName,$supplierMobileNumber,$showAddSupplierModal = false;

    //filters 
    public $firstNameFilter = null;
    public $lastNameFilter = null;

    public $createdOnFilter = null;
    public $createdByFilter = null;

    protected $updatesQueryString = ['paginate'];
    protected $listeners = ['deleteRecord','exportSelected'];

    public $sortField = 'created_on',$sortFieldName = 'Created On',$sortDirection = 'desc';

    public function mount()
    {
        $this->paginate = request()->query('paginate', $this->paginate);
        $this->allSuppliers = $this->suppliersQuery->pluck('id')->toArray();
        $this->suppliersInPage = $this->suppliers->pluck('id')->toArray();
    }

    public function setPaginate($value)
    {
        $this->paginate = $value;
    }

    public function deleteRecord($checkedItems)
    {
        Suppliers::whereIn('id', $checkedItems)->delete();
        session()->flash('message', 'Records deleted successfully.');
    }

    public function getSuppliersQueryProperty(){
        return Suppliers::orderBy($this->sortField,$this->sortDirection)
        ->when($this->firstNameFilter, function($query){
            $query->where('first_name','like','%'.trim($this->firstNameFilter).'%');
        })
        ->when($this->lastNameFilter, function($query){
            $query->where('last_name','like','%'.trim($this->lastNameFilter).'%');
        })
        ->when($this->createdOnFilter, function($query){
            $query->where('created_on','like','%'.trim($this->createdOnFilter).'%');
        })
        ->when($this->createdByFilter, function($query){
            $query->where('created_by','like','%'.trim($this->createdByFilter).'%');
        });
    }

    public function getSuppliersProperty(){
        return $this->suppliersQuery->paginate($this->paginate);
    }
    
    public function exportSelected(array $checked){
        return (new SuppliersExport($checked))->download(fileName: now().' -suppliers-list.xlsx');
    }

    public function updatedPaginate(){
        $this->suppliersInPage = $this->suppliers->pluck('id')->toArray();
    }

    public function changeSortDirection()
    {
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        $this->suppliersInPage = $this->suppliers->pluck('id')->toArray();
    }

    public function changeSortField($sortField,$sortFieldName)
    {
        if ($this->sortField <> $sortField) {
            $this->sortField = $sortField;
            $this->sortFieldName = $sortFieldName;
            
        }
        $this->suppliersInPage = $this->suppliers->pluck('id')->toArray();
    }


    public function submit(){
        $this->validate([
            'supplierFirstName' => 'required|min:2',
            'supplierLastName' => 'required|min:2',
            'supplierMobileNumber' => 'required|min:10',
        ]);

        $first_name = ucwords(strtolower(Str::of($this->supplierFirstName)->trim(' ')));
        $last_name = ucwords(strtolower(Str::of($this->supplierLastName)->trim(' ')));

        $exists = Suppliers::where('first_name', $first_name)
        ->where('last_name', $last_name)
        ->where('mobile_number', $this->supplierMobileNumber)
        ->exists();

        if($exists){
            $this->alert('error', 'Supplier already exists!');
            return;
        }

        $gencode = $this->generateSupplierNumber();
        $supplier = new Suppliers;
        $supplier->code = $gencode;
        $supplier->first_name = $first_name ;
        $supplier->last_name = $last_name;
        $supplier->mobile_number = $this->supplierMobileNumber;
        $supplier->status = 'Active';
        $supplier->created_on      = Carbon::now();
        $supplier->created_by      = Auth::user()->getNameOrUsername();

        if($supplier->save()){
            $this->showAddSupplierModal = false;
            $this->alert('success', 'Supplier added successfully !');
        }else{
            $this->alert('error', 'Failed to add supplier !');
        }
    }

    public function generateSupplierNumber()
    
    {
        $number = Serials::where('name','Supplier')->first();
        $count  = $number->counter;
        $prefix = $number->prefix;
     
        $agentnumber = str_pad($count+1,4, '0', STR_PAD_LEFT);
     
        $generated = $prefix.$agentnumber;

        Serials::where('name','Supplier')->increment('counter',1);

        return $generated;      
    }


    public function render()
    {
        $suppliers = $this->suppliers;
        return view('livewire.suppliers-list',compact('suppliers'));
    }
}
