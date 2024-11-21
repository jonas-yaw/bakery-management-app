<div
style="font-family: 'Nunito'"
x-cloak
x-data="{
  searchResultsrows: @entangle('searchResultsrows'),
  showSearchListModal: @entangle('showSearchListModal'),
  currentSearchRow: @entangle('currentSearchRow'),
  currentSearchRowIndex: @entangle('currentSearchRowIndex'),
  currentAddedItemRowArr: @entangle('currentAddedItemRowArr'),
  currentAddedItemRowIndex: @entangle('currentAddedItemRowIndex'),
  discount_x:@entangle('discount'),
  deliveryFee_x:@entangle('deliveryFee'),
  customerName_x:@entangle('customerName'),
  customerMobileNumber_x:@entangle('customerMobileNumber'),
  payment_mode_model: @entangle('paymentMode'),
  amountCollected_x: @entangle('amountCollected'),
  balance_x: @entangle('balance'),
  getSearchResultsRowPrice(row,index,selectedValue){
    this.currentSearchRow = row;
    this.currentSearchRowIndex = index;
    Livewire.dispatch('updateSearchRowPrice',{ value:selectedValue });
  },
  getAddedToCartRowPrice(row,index,selectedValue){
    this.currentAddedItemRowArr = row;
    this.currentAddedItemRowIndex = index;
    Livewire.dispatch('updateAddedToCartRowPrice',{ value:selectedValue });
  },
  addedItemsRowArr: @entangle('addedItemsRowArr'),
  addItemsToCart(index){
    Livewire.dispatch('addItemsToCart',{ index:index });
  },
  toggleItemSellingQuantity(row,index,action){
    this.currentAddedItemRowArr = row;
    this.currentAddedItemRowIndex = index;
   Livewire.dispatch('toggleItemSellingQuantity',{ action:action });
  },
  removeAddedCartItem(index){
   Livewire.dispatch('removeAddedCartItem',{ index:index });
  },
   get totalSum() {
      return this.addedItemsRowArr.reduce((sum, row) => sum + parseFloat(row.total_price), 0).toFixed(2);
   },
    get outstanding() {
        const totalPrice = this.addedItemsRowArr.reduce((sum, row) => {
            const price = parseFloat(row.total_price) || 0; // Fallback to 0 if not a valid number
            return sum + price;
        }, 0);

        const outstandingAmount = parseFloat(this.amountCollected_x) - totalPrice || 0; // Fallback to 0 if invalid
        this.balance_x = outstandingAmount.toFixed(2);
        return outstandingAmount.toFixed(2);
    }

}"
>

    <div class="tw-px-10">
        <div class="input-group rounded">
            <input type="search" 
            id="product_search" 
            class="form-control rounded" 
            placeholder="Scan/Search Product by Code Or Name" 
            aria-label="Search" 
            aria-describedby="search-addon"
            wire:model.live.debounce.200ms="searchInput"
            />
            <span class="input-group-text border-0" id="search-addon" style="background-color: transparent;cursor: pointer;">
              <i class="fa fa-search" wire:click="searchItemRegex"></i>
            </span>
          </div>
    </div>


    <form wire:submit.prevent="submit" class="tw-w-full">
    <div class=" tw-mt-8">
        <div class="table-responsive">
        <div class="tw-relative tw-overflow-x-auto tw-shadow-md tw-rounded-tl-lg tw-rounded-tr-lg  tw-border">
            <table class=" tw-w-full tw-text-black">
                <thead>
                    <tr class="">
                        <th class="tw-px-4 tw-py-2 tw-border-b tw-rounded-lg" scope="col">#</th>
                        <th class="tw-border-l tw-border-b  tw-text-center tw-font-semibold" style="font-size: 14px" scope="col">Item</th>
                        <th class="tw-border-l tw-border-b tw-text-center tw-font-semibold" style="font-size: 14px" scope="col">Quantity</th>
                        <th class="tw-border-l tw-border-b tw-text-center tw-font-semibold" style="font-size: 14px" scope="col">Size</th>
                        <th class="tw-border-l tw-border-b tw-text-center tw-font-semibold" style="font-size: 14px" scope="col">Price</th>
                        <th class="tw-border-l tw-border-b tw-text-center tw-font-semibold" style="font-size: 14px" scope="col">Sub Total Price</th>
                        <th 
                          :class="{
                            'tw-border-b': true,
                            'tw-border-l': addedItemsRowArr.length > 0 
                            }" scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr x-show="addedItemsRowArr.length == 0" id="no_data_row">
                        <td colspan="7">
                            <p class="tw-text-center tw-p-8">No Data Available</p>
                        </td>
                    </tr>

                    <template x-show="addedItemsRowArr.length > 0" x-for="(row, index) in addedItemsRowArr" :key="index">
                        <tr  :class="{
                            'tw-border-t': true,
                            'tw-border-b': index != (addedItemsRowArr.length - 1) 
                            }"
                        >
                            <td class="tw-p-4" x-text="index"></td>
                            <td class="tw-border-l tw-text-center tw-uppercase" x-text="row.item"></td>
                            <td class="tw-border-l tw-text-center">
                                <div class="tw-flex tw-flex-row tw-gap-4 tw-justify-center tw-items-center">
                                    <x-heroicon-o-minus-circle class="tw-w-8 tw-h-8 tw-text-black tw-cursor-pointer"  @click="toggleItemSellingQuantity(row,index,'decrement')" /> 
                                    <span x-text="row.selling_quantity"></span>
                                    <x-heroicon-o-plus-circle class="tw-w-8 tw-h-8 tw-text-black tw-cursor-pointer" @click="toggleItemSellingQuantity(row,index,'increment')" /> 
                                </div>
                            </td>
                            <td class="tw-border-l tw-text-center">
                                <select x-show="row.sizes_and_prices.length > 0" name="" id="" class="tw-text-center tw-w-20 tw-outline-none focus:ring-0"
                                    x-on:change="getAddedToCartRowPrice(row,index,$event.target.value)"
                                >
                                    <template x-for="(entry, sizeIndex) in row.sizes_and_prices" :key="sizeIndex">
                                        <option :value="entry.size" x-text="entry.size"></option>
                                    </template>
                                </select>
                            </td> 

                            <td class="tw-border-l tw-text-center" x-text="">
                                <input class=" tw-w-20 tw-text-right" type="text" :value="row.price_per_unit">
                            </td>  
                            <td class="tw-border-l tw-text-center" x-text="row.total_price"></td>
                            <td class="tw-border-l tw-text-center tw-border">
                                <div class="tw-flex tw-flex-row tw-justify-center tw-items-center">
                                    <x-heroicon-o-trash class="tw-w-5 tw-h-5 tw-text-rose-600 tw-cursor-pointer" @click="removeAddedCartItem(index)" />
                                </div>
                            </td>                    
                        </tr>
                    </template>
              
                </tbody>
            </table>
        </div>
        </div>
    </div>

    <div>
        <div class="tw-flex tw-flex-row tw-justify-end tw-mt-3">
            <div class="tw-text-white tw-bg-blue-800 tw-font-semibold tw-px-12 tw-py-2 tw-rounded-md">Total: <span x-text="totalSum"></span></div>
        </div>
    </div>

    <hr class=" tw-bg-neutral-300">

    <div>
        <div class="tw-flex tw-flex-col md:tw-grid md:tw-grid-cols-4 tw-gap-2 tw-mb-10">
            <x-float-input 
            label='Discount' 
            inputID='discount' 
            model='discount' 
            x_model='discount_x'
            errorMessage={{ $message }} 
            :error="$errors->first('discount')" 
            ></x-float-input>
  
            <x-float-input 
            label='Delivery Fee' 
            inputID='deliveryFee' 
            model='deliveryFee' 
            x_model='deliveryFee_x'
            errorMessage={{ $message }} 
            :error="$errors->first('deliveryFee')" 
            ></x-float-input>
  
            <x-text-input 
            label='Name' 
            inputID='customerName' 
            model='customerName' 
            x_model='customerName_x'
            errorMessage={{ $message }} 
            :error="$errors->first('customerName')" 
            ></x-text-input>
  
            <x-text-input 
            label='Mobile Number' 
            inputID='customerMobileNumber' 
            model='customerMobileNumber' 
            x_model='customerMobileNumber_x'
            errorMessage={{ $message }} 
            :error="$errors->first('customerMobileNumber')" 
            ></x-text-input>
        </div>

 

        <div class="tw-flex tw-flex-col md:tw-grid md:tw-grid-cols-4 tw-gap-2 tw-mb-10">
            <div class="tw-px-3">
                <x-select-input 
                x_model="payment_mode_model"
                label='Payment mode' 
                inputID='paymentMode' 
                :arr="$payment_modes" 
                reference='type' 
                model='paymentMode' 
                errorMessage={{ $message }} 
                :error="$errors->first('paymentMode')" 
                />
            </div>

            <div  x-show="payment_mode_model == 'Mobile Money'">
                <x-text-input 
                label='Mobile Money Number' 
                inputID='referenceNumber' 
                model='referenceNumber' 
                errorMessage={{ $message }} 
                :error="$errors->first('referenceNumber')" 
                ></x-text-input>
            </div>

            <x-float-input 
            label='Amount Collected' 
            inputID='amountCollected' 
            model='amountCollected' 
            x_model='amountCollected_x'
            errorMessage={{ $message }} 
            :error="$errors->first('amountCollected')" 
            ></x-float-input>
  
            <div class="tw-w-full tw-md:w-1/3 tw-px-3">
                <label class="tw-block tw-uppercase tw-tracking-wide tw-text-gray-700 tw-font-bold tw-mb-2" for="grid-last-name">
                    Balance
                </label>
                <input 
                    class="tw-appearance-none tw-block tw-w-full tw-bg-gray-100 tw-text-gray-700 tw-border tw-border-gray-200 tw-rounded tw-py-[9.5px] tw-px-4 tw-leading-tight tw-focus:outline-none tw-focus:bg-white tw-focus:border-gray-500"
                    type="text" 
                    id="outstanding" 
                    wire:model.live.debounce.200ms="balance" 
                    x-model="balance_x"
                    x-bind:value="outstanding"
                    disabled
                />
            </div>
        </div>

    </div>

    <hr class=" tw-bg-neutral-300">
    <div>
        <div class="tw-flex tw-flex-row tw-justify-end tw-mt-3">
            <button 
            class="tw-text-white tw-bg-emerald-600 tw-font-semibold tw-px-12 tw-py-2 tw-rounded-md tw-cursor-pointer hover:tw-shadow-md"
            type="submit"
            >Checkout</button>
        </div>
    </div>
    </form>

    {{-- modaLs --}}
    <x-custom-modal title="Search List" showModal="showSearchListModal">
        <div>
            <div class="table-responsive tw-px-3">
                <table class="tw-w-full tw-p-2">
                    <thead>
                        <th class="tw-text-black tw-py-2 tw-font-semibold">Item</th>
                        <th class="tw-text-black tw-font-semibold">Category</th>
                        <th class="tw-text-black tw-font-semibold">Brand</th>
                        <th class="tw-text-black tw-font-semibold tw-text-center">Quantity</th>
                        <th class="tw-text-black tw-font-semibold tw-text-center">Size</th>
                        <th class="tw-text-black tw-font-semibold tw-text-right">Price</th>
                        <th></th>
                    </thead>

                    <tbody class="tw-text-black">
                        <template x-for="(row, index) in searchResultsrows" :key="index">
                            <tr class=" tw-border-t tw-border-b-slate-400">
                                <td class="tw-py-3 tw-uppercase " x-text="row.item"></td>
                                <td class="" x-text="row.category"></td>
                                <td class="" x-text="row.brand"></td>
                                <td class=" tw-text-center" x-text="row.quantity"></td>      
                                <td class=" tw-text-center">
                                    <select x-show="row.sizes_and_prices.length > 0" name="" id="" class="tw-text-center tw-w-20"
                                     x-on:change="getSearchResultsRowPrice(row,index,$event.target.value)"
                                    >
                                        <template x-for="(entry, sizeIndex) in row.sizes_and_prices" :key="sizeIndex">
                                            <option :value="entry.size" x-text="entry.size"></option>
                                        </template>
                                    </select>
                                </td>      
                                <td class="tw-text-right" x-text="">
                                    <input class=" tw-w-20 tw-text-right" type="text" :value="row.price_per_unit">
                                </td>    
                                <td>
                                    <div @click="addItemsToCart(index)" class=" tw-bg-slate-700 tw-py-1 tw-text-center tw-text-white tw-rounded-md tw-cursor-pointer tw-px-1 tw-ml-8 tw-text-sm">Add</div>
                                </td>  
                                                       
                            </tr>
                        </template>
                        
                    </tbody>
                </table>
            </div> 
        </div>
     
    </x-custom-modal>
</div>
