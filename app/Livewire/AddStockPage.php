<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Image;
use App\Models\Stock;
use App\Models\Brands;
use App\Models\Serials;
use Livewire\Component;
use App\Models\Suppliers;
use App\Models\Categories;
use Livewire\WithFileUploads;
use App\Models\StockSizeAndPrices;
use App\Models\UnitsOfMeasurement;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddStockPage extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    
    public $editStatus = 'editable',$itemCategory,$itemName,$itemBrand,
    $itemSupplier,$itemQuantity,$itemRestockLimit,$itemCostPrice,
    $itemSellingPrice,
    $status,$itemCode,
    $photo;

    public $rows = [],$currentRow = [],$currentRowIndex = null;

    protected $listeners = ['updateRowSizes','updateEditableState'];

    public function mount($status,$stockItem){
        $this->status = $status;
        if($status == "edit"){
            $this->editStatus = 'uneditable';
            $this->itemCode = $stockItem->code;
            $this->itemCategory = $stockItem->category;
            $this->itemName = $stockItem->item;
            $this->itemBrand = $stockItem->brand;
            $this->itemSupplier = $stockItem->supplier;
            $this->itemQuantity = $stockItem->quantity;
            $this->itemRestockLimit = $stockItem->restock_limit;
            $this->itemCostPrice = $stockItem->cost_price_per_unit;
            $this->itemSellingPrice = $stockItem->price_per_unit;
            $this->photo = $stockItem->image;

        }else{
            $this->itemCode = null;
        }
    }

    public function removePhoto()
    {
        $this->photo = null;
    }

    public function updateEditableState(){
        $this->editStatus = $this->editStatus == 'edit'? 'uneditable':'edit';
    }


    public function updateRowSizes($value){
        if($value['unit_of_measure'] != ''){
            $sizes_available = UnitsOfMeasurement::where('type',$value['unit_of_measure'])
            ->pluck('size')
            ->prepend('');
    
            $this->currentRow['sizes'] = $sizes_available;    
            $this->rows[$this->currentRowIndex]['sizes'] = $sizes_available;
        }else{
            $this->currentRow['sizes'] = [];    
            $this->rows[$this->currentRowIndex]['sizes'] = [];
        }

    }

    public function submit()
    {
        $this->validate([
            'itemCategory' => 'required',
            'itemName' => 'required|min:2',
            'itemBrand' => 'required',
            'itemQuantity' => 'required',
            'itemRestockLimit' => 'required',
            'itemSellingPrice'=>'required',
            'photo' => 'required|mimes:jpg,jpeg,png|max:10240', // 1MB Max
        ]);

         // Check uniqueness
         
         $exists = Stock::where('category', $this->itemCategory)
         ->where('brand', $this->itemBrand)
         ->where('item', $this->itemName)
         ->exists();

        if ($exists && ($this->status == 'new')) {
            $this->alert('error', 'Item already exists !');
            return;
        }
     
        $validateRows = true;

        if(count($this->rows) > 0){
            foreach($this->rows as $row){
                if($row['unit_of_measure'] == ''){
                    $validateRows = false;
                    break;
                }else if($row['conversion_factor'] == ''){
                    $validateRows = false;
                    break;
                }else if($row['amount'] == ''){
                    $validateRows = false;
                    break;
                }
            }    
        }

        if($validateRows){
            $code = $this->itemCode ?? $this->generateStockItemCode();

            $affectedRows = Stock::where('code',$code)->delete();
            
            $affectedRows = $this->status == 'new' ? 1 : $affectedRows;
            if($affectedRows){
                $item = new Stock;
                $item->code       = $code;
                $item->item       = $this->itemName;
                $item->category   = $this->itemCategory;
                $item->brand      = $this->itemBrand;
                $item->supplier   = $this->itemSupplier;
                $item->quantity   = $this->itemQuantity;
                $item->restock_limit   = $this->itemRestockLimit;
                //$item->cost_price_per_unit  = $this->itemCostPrice;
                $item->image = $this->photo->getClientOriginalName();
                $item->price_per_unit  = $this->itemSellingPrice;
                $item->created_on      = Carbon::now();
                $item->created_by      = Auth::user()->getNameOrUsername();
    
                $filepath = 'attachments';
                $this->photo->storeAs($filepath, $this->photo->getClientOriginalName(), 'public');
                
                if($item->save()){
                    if($this->status == 'new'){
                        return redirect()
                        ->route('get-stock')
                        ->with('success','Item added successfully ');
                    }

                    $this->alert('success', 'Item updated successfully !');
                    $this->dispatch('$refresh');
                }else{
                    $this->alert('error', message: 'Process failed to complete !');
                }
            }

        }else{
            $this->alert('error', 'Kindly ensure all row data are filled!');
        }



    }

    public function generateStockItemCode(){
        $number = Serials::where('name','Stock Item')->first();
        $count  = $number->counter;
        $prefix = $number->prefix;
        
        $agentnumber = str_pad($count+1,2, '0', STR_PAD_LEFT);
        
        $generated = $prefix.$agentnumber;
        Serials::where('name','Stock Item')->increment('counter',1);

        return $generated; 
    }

    public function render()
    {
        $categories = Categories::get();
        $brands = Brands::get();
        $suppliers = Suppliers::get();
        $uoms = UnitsOfMeasurement::select('type')->distinct()->pluck('type');

        
        return view('livewire.add-stock-page',[
            'categories' => $categories,
            'brands' => $brands,
            'suppliers' => $suppliers,
            'uoms' => $uoms
        ]);
    }
}
