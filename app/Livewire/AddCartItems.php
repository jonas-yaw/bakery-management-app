<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Stock;
use App\Models\Company;
use Livewire\Component;
use App\Models\Payments;
use App\Models\PaymentType;
use Illuminate\Support\Str;
use App\Models\ExchangeRate;
use App\Models\StockSizeAndPrices;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddCartItems extends Component
{
    use LivewireAlert;
    public $searchInput,$searchResultsrows = [],$showSearchListModal = false,$currentSearchRow = [],$currentSearchRowIndex = null,$selectedSearchValue;

    public $addedItemsRowArr = [],$currentAddedItemRowArr = [],$currentAddedItemRowIndex = null;
    public $discount='0.0',$deliveryFee='0.0',$customerName,$customerMobileNumber,$paymentMode='Cash',$amountCollected,$balance='0.0',$referenceNumber;
    protected $listeners = ['updateSearchRowPrice','addItemsToCart','updateAddedToCartRowPrice','toggleItemSellingQuantity','removeAddedCartItem'];
    

    public function searchItemRegex(){
        try {
            if($this->searchInput != ''){
                $items = Stock::where('item','like','%'.$this->searchInput.'%')
                ->orWhere('brand','like','%'.$this->searchInput.'%')
                ->get(); 
                  
                if($items->count() > 0){
                    $this->searchResultsrows = [];
    
                    foreach($items as $item){
                        $stockEntryRows = StockSizeAndPrices::where('code',$item->code)->get()->toArray();
    
                        $this->searchResultsrows[] = [       
                            'id' => $item->id,
                            'code' => $item->code,
                            'item' => $item->item,
                            'category' => $item->category,
                            'brand' => $item->brand,
                            'quantity' => $item->quantity,
                            'price_per_unit' => count($stockEntryRows) > 1 ? $stockEntryRows[0]['price_per_unit'] : $item->price_per_unit,
                            'restock_limit' => $item->restock_limit,
                            'sizes_and_prices' => $stockEntryRows
                        ];
                    }
    
                    $this->showSearchListModal = true;
                }else{
                    $this->alert('error', 'Item not available!');
                }
            }

        
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function updateSearchRowPrice($value){
        $this->selectedSearchValue = $value;

        $result = array_filter($this->currentSearchRow['sizes_and_prices'], function ($item) {
            return $item['size'] === $this->selectedSearchValue;
        });

        $found = reset($result); 

        $this->currentSearchRow['price_per_unit'] = $found['price_per_unit'];    
        $this->searchResultsrows[$this->currentSearchRowIndex]['price_per_unit'] = $found['price_per_unit'];
        //$value->sizes_and_prices

    }

    public function updateAddedToCartRowPrice($value){
        $this->selectedSearchValue = $value;

        $result = array_filter($this->currentAddedItemRowArr['sizes_and_prices'], function ($item) {
            return $item['size'] === $this->selectedSearchValue;
        });

        $found = reset($result); 

        $this->currentAddedItemRowArr['selected_uom'] = $found['uom'];    
        $this->addedItemsRowArr[$this->currentAddedItemRowIndex]['selected_uom'] = $found['uom'];

        $this->currentAddedItemRowArr['selected_size'] = $found['size'];    
        $this->addedItemsRowArr[$this->currentAddedItemRowIndex]['selected_size'] = $found['size'];

        $this->currentAddedItemRowArr['price_per_unit'] = $found['price_per_unit'];    
        $this->addedItemsRowArr[$this->currentAddedItemRowIndex]['price_per_unit'] = $found['price_per_unit'];
        //$value->sizes_and_prices
        $count = $this->currentAddedItemRowArr['selling_quantity'];
        $this->currentAddedItemRowArr['total_price'] = number_format($count* $found['price_per_unit'],2);
        $this->addedItemsRowArr[$this->currentAddedItemRowIndex]['total_price'] = number_format($count* $found['price_per_unit'],2);

    }

    public function addItemsToCart($index){
        $itemExists = false;
        $row = $this->searchResultsrows[$index];

        if(count($this->addedItemsRowArr) > 0){
            foreach($this->addedItemsRowArr as $item){
                if($item['id'] == $row['id']){
                    $itemExists = true;
                    break;
                }
            }

            if(!$itemExists){
                $this->addedItemsRowArr[] = [
                    'id' => $row['id'],
                    'code' => $row['code'],
                    'item' => $row['item'],
                    'category' => $row['category'],
                    'brand' => $row['brand'],
                    'quantity' => $row['quantity'],
                    'selling_quantity' => 1,
                    'price_per_unit' => $row['price_per_unit'],
                    'restock_limit' => $row['restock_limit'],
                    'sizes_and_prices' => $row['sizes_and_prices'],
                    'selected_uom' => count($row['sizes_and_prices']) > 0 ?  $row['sizes_and_prices'][0]['uom'] : '',
                    'selected_size' => count($row['sizes_and_prices']) > 0 ?  $row['sizes_and_prices'][0]['size'] : '',
                    'total_price' => $row['price_per_unit']
                ];
            }
        }else{
            //$this->addedItemsRowArr[] = $row;
            $this->addedItemsRowArr[] = [
                'id' => $row['id'],
                'code' => $row['code'],
                'item' => $row['item'],
                'category' => $row['category'],
                'brand' => $row['brand'],
                'quantity' => $row['quantity'],
                'selling_quantity' => 1,
                'price_per_unit' => $row['price_per_unit'],
                'restock_limit' => $row['restock_limit'],
                'sizes_and_prices' => $row['sizes_and_prices'],
                'selected_uom' => count($row['sizes_and_prices']) > 0 ?  $row['sizes_and_prices'][0]['uom'] : '',
                'selected_size' => count($row['sizes_and_prices']) > 0 ?  $row['sizes_and_prices'][0]['size'] : '',
                'total_price' => $row['price_per_unit']
            ];
        }

        
    }

    public function toggleItemSellingQuantity($action){
        if($action == 'increment'){
            $count = $this->currentAddedItemRowArr['selling_quantity'] +1;
        }else if($action == 'decrement'){
            $count = $this->currentAddedItemRowArr['selling_quantity'] - 1;
        }

        $count = $count == 0 ? 1 : $count;

        $this->currentAddedItemRowArr['selling_quantity'] = $count;
        $this->addedItemsRowArr[$this->currentAddedItemRowIndex]['selling_quantity'] = $count;
        $this->currentAddedItemRowArr['total_price'] = number_format($count* $this->currentAddedItemRowArr['price_per_unit'],2) ;
        $this->addedItemsRowArr[$this->currentAddedItemRowIndex]['total_price'] = number_format($count* $this->currentAddedItemRowArr['price_per_unit'],2) ;
    }

    public function removeAddedCartItem($index){
        array_splice($this->addedItemsRowArr, $index, 1);
    }

    public function submit(){
        $this->validate([
            'paymentMode' => 'required',
            'amountCollected' => 'required',
            'balance' => 'required',
            'referenceNumber' => $this->paymentMode === 'Mobile Money' ? 'required' : 'nullable'
        ]);
        
        if(count($this->addedItemsRowArr) < 1){
            $this->alert('error', 'Kindly add items!');
            return;
        }

        if($this->balance < 0){
            $this->alert('error', 'Amount collected cannot be less than total price!');
            return; 
        }

        $company = Company::first();
        $exchanges  =  ExchangeRate::where('type',$company->currency)->first();
        $genreceiptnumber = app('App\Http\Controllers\InvoiceController')->generateReceiptNumber();
        $geninvoicenumber = app('App\Http\Controllers\InvoiceController')->generateInvoiceNumber();
        $debit_date = Carbon::now();

        $affectedRows = 0;
        foreach($this->addedItemsRowArr as $item) {
            $stockItemDetails = Stock::where('code',$item['code'])->first();

            $payment                               = new Payments;
            $payment->receipt_type                 = 'Sales';
            $payment->receipt_number               = $genreceiptnumber;
            $payment->invoice_number               = $geninvoicenumber;
            $payment->receipt_date                 = Carbon::now();
            $payment->debit_date                   = $debit_date;
            $payment->currency                     = $company->currency;
            $payment->price_per_unit               = $item['price_per_unit'];
            $payment->cost_price_per_unit          = $stockItemDetails->cost_price_per_unit;
            $payment->sub_total_price              = $item['total_price'];
            $payment->amount_paid                  = $item['total_price'];
            $payment->collection_mode              = $this->paymentMode;
            $payment->reference_number             = $this->referenceNumber;
            $payment->paid_by                      = ucwords(strtolower(Str::of($this->customerName)->trim(' ')));
            $payment->created_on                   = Carbon::now();
            $payment->created_by                   = Auth::user()->getNameOrUsername();
            $payment->reference                    = $item['code'];
            $payment->product                      = $item['item'];
            $payment->category                     = $item['category'];
            $payment->uom                          = $item['selected_uom'];
            $payment->size                         = $item['selected_size'];
            $payment->quantity                     = $item['selling_quantity'];
            $payment->customer_name                = ucwords(strtolower(Str::of($this->customerName)->trim(' ')));
            $payment->customer_mobile_number       = $this->customerMobileNumber;
            $payment->exchange_rate                = $exchanges->rate;
            $payment->discount_fee                 = $this->discount;
            $payment->delivery_fee                 = $this->deliveryFee;
            $payment->tendered_amount              = $this->amountCollected;
            $payment->balance                      = $this->balance;

            $affectedRows += $payment->save();
        }

        if($affectedRows > 0){
            return redirect()
            ->route('get-payments')
            ->with('success','Transaction processed successfully !');
        }else{
            $this->alert('error', 'Failed to process transaction.');
        }
    }

    public function render()
    {
        return view('livewire.add-cart-items',[
            'payment_modes' => PaymentType::all(),
        ]);
    }
}
