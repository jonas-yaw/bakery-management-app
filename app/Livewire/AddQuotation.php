<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Stock;
use App\Models\Serials;
use Livewire\Component;
use App\Models\Quotation;
use App\Models\QuotationItem;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddQuotation extends Component
{
    use LivewireAlert;
    
    public $status,$editStatus = 'editable';
    public $rows = [],$currentRow = [],$currentRowIndex = null;

    public $quotationDate,$customerName,$customerMobileNumber,$customerAddress,$comment,$quotation;

    protected $listeners = ['updateRowSizes','updateEditableState'];

    public function mount($status,$quotation){
        $this->status = $status;
        $this->quotationDate = Carbon::now()->format('Y-m-d');
        
        if($status == "edit"){
            $this->quotation = $quotation;
            $this->quotationDate = $quotation->quotation_date;
            $this->customerName = $quotation->customer_name;
            $this->customerMobileNumber = $quotation->customer_mobile_number;
            $this->customerAddress = $quotation->customer_address;
            $this->comment = $quotation->comment;

            $items = QuotationItem::where('transaction_key',$quotation->transaction_key)->get();
            foreach($items as $item){
                $this->rows[] = [       
                    'search' => $item->item_name,
                    'item_code' => $item->item_code,
                    'items' => [$item->item_name],
                    'quantity' => $item->quantity,
                    'price_per_unit' => $item->price_per_unit,
                    'total_amount' => $item->amount,
                ];
            }
        }else{
            $this->itemCode = null;
        }
    }

 /*    public function updated($propertyName)
    {
        foreach ($this->rows as $index => $row) {
            if ($propertyName === "rows.$index.search") {
                dd($this->rows[$index]);
                $this->rows[$index]['items'] = Stock::where('item', 'like', '%' . $row['search'] . '%')
                    ->take(10)
                    ->get()
                    ->toArray();
            }
        }
    } */

    public function updateRowSearch($index, $value)
    {
        $this->rows[$index]['search'] = $value;

        // Fetch matching items for the dropdown
        $this->rows[$index]['items'] = Stock::where('item', 'like', '%' . $value . '%')
            ->take(10)
            ->get()
            ->toArray();
    }

    public function submit(){
        $this->validate([
            'quotationDate' => 'required',
            'customerName' => 'required|min:2',
            'customerMobileNumber' => 'required',
            'customerAddress' => 'required',
        ]);

        if(count($this->rows) > 0){
            $validateRows = true;

            foreach($this->rows as $row){
                if($row['search'] == ''){
                    $validateRows = false;
                    break;
                }else if($row['quantity'] == ''){
                    $validateRows = false;
                    break;
                }else if($row['price_per_unit'] == ''){
                    $validateRows = false;
                    break;
                }else if($row['total_amount'] == '' || $row['total_amount'] == 0){
                    $validateRows = false;
                    break;
                }
            }    

            if($validateRows){
                $code = $this->itemCode ?? $this->generateQuotationCode();
                $transaction_key = uniqid(10);
                $affectedRows = Quotation::where('quotation_number',$code)->delete();

                $total_amount = 0;
                foreach($this->rows as $row){
                    $total_amount = floatval(preg_replace("/[^-0-9\.]/", "", $row['total_amount']));
                }

                $quotation = new Quotation;
                $quotation->quotation_number          = $code;
                $quotation->quotation_date            = $this->quotationDate;
                $quotation->customer_name             = $this->customerName;
                $quotation->customer_mobile_number    = $this->customerMobileNumber;
                $quotation->customer_address          = $this->customerAddress;
                $quotation->total_amount              = $total_amount;
                $quotation->comment                   = $this->comment;
                $quotation->created_by                = Auth::user()->getNameOrUsername();
                $quotation->created_on                = Carbon::now();
                $quotation->updated_by                = Auth::user()->getNameOrUsername();
                $quotation->updated_on                = Carbon::now();
                $quotation->transaction_key           = $transaction_key;
                
                if($quotation->save()){
                    foreach($this->rows as $row){
                        $stockItem = Stock::where('code', $row['item_code'])->first();

                        $item = new QuotationItem;
                        $item->quotation_number       = $code;
                        $item->item_code              = $stockItem->code;
                        $item->item_name              = $stockItem->item;
                        $item->quantity               = $row['quantity'];
                        $item->price_per_unit         = $stockItem->price_per_unit;
                        $item->amount                 = floatval(preg_replace("/[^-0-9\.]/", "", $row['total_amount']));
                        $item->created_by             = Auth::user()->getNameOrUsername();
                        $item->created_on             = Carbon::now();
                        $item->updated_by             = Auth::user()->getNameOrUsername();
                        $item->updated_on             = Carbon::now();
                        $item->transaction_key        = $transaction_key;

                        $item->save();
                    }


                    if($this->status == 'new'){
                        return redirect()
                        ->route('get-quotations')
                        ->with('success','Quotation added successfully ');
                    }

                    $this->alert('success', 'Quotation updated successfully !');
                    $this->dispatch('$refresh');
                }else{
                    $this->alert('error', message: 'Process failed to complete !');
                }
            }else{
                $this->alert('error', 'Kindly ensure all row data are filled!');
            }
        }else{
            $this->alert('error', 'Kindly add a row !');
        }
    }

    public function generateQuotationCode(){
        $number = Serials::where('name','Quotation')->first();
        $count  = $number->counter;
        $prefix = $number->prefix;
        
        $agentnumber = str_pad($count+1,2, '0', STR_PAD_LEFT);
        
        $generated = $prefix.$agentnumber;
        Serials::where('name','Quotation')->increment('counter',1);

        return $generated; 
    }

    public function render()
    {
        return view('livewire.add-quotation');
    }
}
