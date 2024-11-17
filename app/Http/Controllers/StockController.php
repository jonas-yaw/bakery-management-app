<?php

namespace App\Http\Controllers;

use Response;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Stock;
use App\Models\Brands;
use App\Models\Company;
use App\Models\Serials;
use App\Models\Customer;
use App\Models\Payments;
use App\Models\Suppliers;
use App\Models\AccountType;
use App\Models\PaymentType;
use Illuminate\Support\Str;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use App\Models\StockCategory;
use NumberToWords\NumberToWords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $query = Stock::query();

        if($request->search){
            $query->where('code','like', '%'.$request->search.'%')
            ->orWhere('item','like', '%'.$request->search.'%');
        }

        $stock = $query->orderBy('id','desc')->paginate(30);
        $stock_category = StockCategory::get();
        $brands = Brands::get();
        $suppliers = Suppliers::get();

        return view('stock.index',compact('stock','stock_category','brands','suppliers'));
    }


    public function getCatalogue(Request $request){
        $query = Stock::query();

        if($request->search){
            $query->where('code','like', '%'.$request->search.'%')
            ->orWhere('item','like', '%'.$request->search.'%');
        }
        $catalogue = $query->orderBy('id','desc')->paginate(30);

        return view('stock.catalogue_page',compact('catalogue'));
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

    public function addStockItem(Request $request){
       
        $item = new Stock;
        $item->code       = $this->generateStockItemCode();
        $item->barcode    = $request->item_barcode;
        $item->item       = strtoupper(Str::of($request->item_name)->trim(' '));
        $item->category   = $request->item_category;
        $item->brand      = ucwords(strtolower(Str::of($request->item_brand)->trim(' ')));
        $item->supplier   = $request->item_supplier;
        $item->quantity   = $request->quantity;
        $item->restock_limit   = $request->restock_limit;
        $item->cost_price_per_unit  = $request->cost_price_per_unit;
        $item->price_per_unit  = $request->price_per_unit;
        $item->created_on      = Carbon::now();
        $item->created_by      = Auth::user()->getNameOrUsername();

        if(ucwords(strtolower(Str::of($request->item_brand)->trim(' ')))){
            $brands = Brands::firstOrCreate(
                ['type' => ucwords(strtolower(Str::of($request->item_brand)->trim(' ')))], // Searc// Additional attributes for creation
            );    
        }
        
        if ($item->save()) {
            return redirect()
            ->route('get-stock')
            ->with('success','Item has successfully been added!');
        }else{
            return redirect()
            ->route('get-stock')
            ->with('error','Failed to add item');
        }
    }

    public function updateStockItem(Request $request){
        $id = Crypt::decrypt($request->key);

        $affectedRows = Stock::where('id',$id)->update([
            'barcode'    => $request->item_barcode,
            'item'      => strtoupper(Str::of($request->item_name)->trim(' ')),
            'category'  => $request->item_category,
            'brand'     => ucwords(strtolower(Str::of($request->item_brand)->trim(' '))),
            'supplier'  => $request->item_supplier,
            'quantity'  => $request->quantity,
            'restock_limit'   => $request->restock_limit,
            'cost_price_per_unit' => $request->cost_price_per_unit,
            'price_per_unit'  => $request->price_per_unit,
            'updated_on' => Carbon::now(),
            'updated_by' => Auth::user()->getNameOrUsername()
        ]);

        if(ucwords(strtolower(Str::of($request->item_brand)->trim(' ')))){
            $brands = Brands::firstOrCreate(
                ['type' => ucwords(strtolower(Str::of($request->item_brand)->trim(' ')))], // Searc// Additional attributes for creation
            );    
        }

        if ($affectedRows > 0) {
            return redirect()
            ->route('get-stock')
            ->with('success','Item has successfully been updated!');
        }else{
            return redirect()
            ->route('get-stock')
            ->with('error','Failed to update item');
        }
    }

    public function generateCartNumber() 
    {
        $number = Serials::where('name','Cart')->first();
        $count  = $number->counter;
        $prefix = $number->prefix;
        
        $agentnumber = str_pad($count+1,4, '0', STR_PAD_LEFT);
        
        $generated = $prefix.$agentnumber;
        Serials::where('name','Cart')->increment('counter',1);

        return $generated;      
    }

    public function addItemToCart(Request $request){
        $code = $this->generateCartNumber();
        $item = Stock::where('code',$request->item_code)->first();

        $cart = new Cart;
        $cart->cart_number = $code ;
        $cart->item = $item->item;
        $cart->item_code = $item->code;
        $cart->category = $item->category;
        $cart->quantity = 1;
        $cart->price_per_unit = $item->price_per_unit;
        $cart->sub_total_price = $item->price_per_unit;
        $cart->status = 'Pending';
        $cart->created_on = Carbon::now() ;
        $cart->created_by = Auth::user()->getNameOrUsername() ;

        if ($cart->save()) {
            $data = array('status' => 'success');
        } else {
            $data = array('status' => 'failed');
        }

        return  Response::json($data);
    }

    public function getCartItems(){
        $cart_items = Cart::where('status','Pending')->get();
        $company = Company::first();
        $paymentmodes = PaymentType::get();
        $account_types = AccountType::get();

        return view('stock.cart_page',compact('cart_items','company','paymentmodes','account_types'));
    }

    public function doCheckout(Request $request){
       //dd($request);
 
        $company = Company::first();
        $exchanges       =  ExchangeRate::where('type',$company->currency)->first();

		$itemsCount = count($request->item_code);

        $genreceiptnumber = app('App\Http\Controllers\InvoiceController')->generateReceiptNumber();
        $geninvoicenumber = app('App\Http\Controllers\InvoiceController')->generateInvoiceNumber();

        $tendered_amount = $request->tendered_amount;
        $total_amount = $request->total_price_input;

        $balance = $tendered_amount - $total_amount;
        $debit_date = Carbon::now();

        for ($i=0; $i < $itemsCount; $i++) {
            $stockItemDetails = Stock::where('code',$request->item_code[$i])->first();

            $payment                               = new Payments;
            $payment->receipt_type                 = 'Sales';
            $payment->receipt_number               = $genreceiptnumber;
            $payment->invoice_number               = $geninvoicenumber;
            $payment->receipt_date                 = Carbon::now();
            $payment->debit_date                   = $debit_date;
            $payment->currency                     = $company->currency;
            $payment->price_per_unit               = $request->price_per_unit_input[$i];
            $payment->cost_price_per_unit          = $stockItemDetails->cost_price_per_unit;
            $payment->sub_total_price              = $request->sub_total_price_input[$i];
            $payment->amount_paid                  = $request->sub_total_price_input[$i];
            $payment->collection_mode              = $request->payment_mode;
            $payment->reference_number             = $request->reference_number;
            $payment->paid_by                      = ucwords(strtolower(Str::of($request->customer_name)->trim(' ')));
            $payment->branch                       = Auth::user()->getNameOrUsername();
            $payment->created_on                   = Carbon::now();
            $payment->created_by                   = Auth::user()->getNameOrUsername();
            $payment->reference                    = $request->item_code[$i];
            $payment->product                      = $request->item_name[$i];
            $payment->category                     = $request->item_category[$i];
            $payment->quantity                     = $request->quantity[$i];
            $payment->customer_name                = ucwords(strtolower(Str::of($request->customer_name)->trim(' ')));
            $payment->customer_mobile_number       = $request->mobile_number;
            $payment->exchange_rate                = $exchanges->rate;
            $payment->discount_fee                 = $request->discount_fee;
            $payment->delivery_fee                 = $request->delivery_fee;
            $payment->tendered_amount              = $tendered_amount;
            $payment->balance                      = $balance;

            $affectedRows = $payment->save();
        }

        if($affectedRows){
            //decrease stock count 
            for ($i=0; $i < $itemsCount; $i++) {
                $currentQuantity = Stock::where('code', $request->item_code[$i])->value('quantity');
                $newQuantity = $currentQuantity - $request->quantity[$i];

                $affectedRows2 = Stock::where('code',$request->item_code[$i])
                ->update([
                    'quantity'    => $newQuantity,
                ]);
            }

            return redirect()
            ->route('get-payments')
            ->with('success','Transaction has successfully been created!');
        }else{
            return redirect()
            ->back()
            ->with('error','Failed to create transaction');
        }
    }

    public function fetchStockItemDetails(Request $request){
        try {
            $id = Crypt::decrypt($request->id);
            $item = Stock::find($id);
            $data = array(
                'id' => $item->id,
                'barcode' => $item->barcode,
                'code' => $item->code,
                'item' => $item->item,
                'category' => $item->category,
                'brand' => $item->brand,
                'restock_limit' => $item->restock_limit,
                'quantity' => $item->quantity,
                'cost_price_per_unit' => $item->cost_price_per_unit,
                'price_per_unit' => $item->price_per_unit,
                'supplier' => $item->supplier,
            );
            return  Response::json($data);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    public function findStockItem(Request $request){
        try {
            $search = $request->search;
            
            //$item = Stock::whereRaw('match(`barcode`,`item`) against('."'+$search*'".' IN BOOLEAN MODE) AND id >= 0')->first();
            $item = Stock::where('barcode',$search)->get();
            
            if($item->count() == 0){            
                $item = Stock::where('item',$search)
                ->orWhere('brand',$search)
                ->get(); 
            }
            
            if($item){
                if($item->count() > 1){
                    $data = array(
                        'count' => $item->count(),
                        'items' => $item,
                        'data_status'   => 'success'
                    );
                }else{
                    $data = array(
                        'count' => 1,
                        'id' => $item[0]->id,
                        'code' => $item[0]->code,
                        'item' => $item[0]->item,
                        'category' => $item[0]->category,
                        'quantity' => $item[0]->quantity,
                        'price_per_unit' => $item[0]->price_per_unit,
                        'restock_limit' => $item[0]->restock_limit,
                        'data_status'   => 'success'
                    );
                }
                
            }else{
                $data = array(
                    'data_status'   => 'none'
                );
            }
            
            
            return  Response::json($data);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    public function findStockItemRegex(Request $request){
        try {
            $search = $request->search;
            $item = Stock::where('item','like','%'.$search.'%')
            ->orWhere('brand','like','%'.$search.'%')
            ->get(); 
              
            if($item){
                if($item->count() > 1){
                    $data = array(
                        'count' => $item->count(),
                        'items' => $item,
                        'data_status'   => 'success'
                    );
                }else{
                    $data = array(
                        'count' => 1,
                        'id' => $item[0]->id,
                        'code' => $item[0]->code,
                        'item' => $item[0]->item,
                        'category' => $item[0]->category,
                        'quantity' => $item[0]->quantity,
                        'price_per_unit' => $item[0]->price_per_unit,
                        'restock_limit' => $item[0]->restock_limit,
                        'data_status'   => 'success'
                    );
                }
                
            }else{
                $data = array(
                    'data_status'   => 'none'
                );
            }
            
            
            return  Response::json($data);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getSuppliers(Request $request){
        $query = Suppliers::query();
        $query->where('status','Active');

        if($request->search){
            $query->where('first_name','like', '%'.$request->search.'%')
            ->orWhere('last_name','like', '%'.$request->search.'%')
            ->orWhere('mobile_number','like', '%'.$request->search.'%');
        }

        $suppliers = $query->orderBy('id','desc')->paginate(30);

        return view('suppliers.index',compact('suppliers'));
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


    public function addSupplier(Request $request){
        $gencode = $this->generateSupplierNumber();
        $supplier = new Suppliers;
        $supplier->code = $gencode;
        $supplier->first_name = ucwords(strtolower(Str::of($request->first_name)->trim(' ')));
        $supplier->last_name = ucwords(strtolower(Str::of($request->last_name)->trim(' ')));
        $supplier->mobile_number = $request->mobile_number;
        $supplier->status = 'Active';

        $supplier->created_on                   = Carbon::now();
        $supplier->created_by                   = Auth::user()->getNameOrUsername();

        if($supplier->save()){
            return redirect()
            ->route('get-suppliers')
            ->with('success','Supplier has successfully been added!');
        }else{
            return redirect()
            ->back()
            ->with('error','Failed to add supplier');
        }

    }

    public function fetchSupplierDetails(Request $request){
        try {
            $id = $request->id;
            $supplier = Suppliers::find($id);
            $data = array(
                'id' => $supplier->id,
                'code' => $supplier->code,
                'first_name' => $supplier->first_name,
                'last_name' => $supplier->last_name,
                'mobile_number' => $supplier->mobile_number,
            );
            return  Response::json($data);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    public function editSupplier(Request $request){
        $id = $request->key;
        $affectedRows = Suppliers::where('id',$id)->update([
            'first_name' => ucwords(strtolower(Str::of($request->first_name)->trim(' '))),
            'last_name' => ucwords(strtolower(Str::of($request->last_name)->trim(' '))),
            'mobile_number' => $request->mobile_number,
            'updated_on' => Carbon::now(),
            'updated_by' => Auth::user()->getNameOrUsername()
        ]);

        if($affectedRows > 0){
            return redirect()
            ->route('get-suppliers')
            ->with('success','Supplier has been updated successfully!');
        }else{
            return redirect()
            ->route('get-suppliers')
            ->with('error','Failed to update supplier');
        }
    }



    public function deleteSupplier(Request $request){
        
        if ($request->id) {
            $ID = Crypt::decrypt($request->id);
            
            $affectedRows = Suppliers::where('id', $ID)->delete();

            if ($affectedRows > 0) {
                $data = array('status' => 'success');
            } else {
                $data = array('status' => 'failed');
            }

        } else {
            $data = array('status' => 'failed');
        }

        return  Response::json($data);
    }

    #---- updated controller for paint app
    public function addStockItemPage(){
        return view('stock.add_stock_item_full_page');
    }

    public function getStockItemDetail($id){
        $code = Crypt::decrypt($id);
        $stockItem = Stock::where('code', $code)->first();
        return view('stock.edit_stock_item_full_page',compact('stockItem'));
    }
}
