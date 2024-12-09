<div
style="font-family: 'Nunito'"
x-cloak
x-data="{
  showCartPage: @entangle('showCartPage'),
  currentAddedItemRowArr: @entangle('currentAddedItemRowArr'),
  currentAddedItemRowIndex: @entangle('currentAddedItemRowIndex'),
  discount_x:@entangle('discount'),
  deliveryFee_x:@entangle('deliveryFee'),
  customerName_x:@entangle('customerName'),
  customerMobileNumber_x:@entangle('customerMobileNumber'),
  payment_mode_model: @entangle('paymentMode'),
  amountCollected_x: @entangle('amountCollected'),
  balance_x: @entangle('balance'),
  getAddedToCartRowPrice(row,index,selectedValue){
    this.currentAddedItemRowArr = row;
    this.currentAddedItemRowIndex = index;
    Livewire.dispatch('updateAddedToCartRowPrice',{ value:selectedValue });
  },
  addedItemsRowArr: @entangle('addedItemsRowArr'),
  removeAddedCartItem(index){
   Livewire.dispatch('removeAddedCartItem',{ index:index });
  },
  toggleItemSellingQuantity(row,index,action){
    this.currentAddedItemRowArr = row;
    this.currentAddedItemRowIndex = index;
   Livewire.dispatch('toggleItemSellingQuantity',{ action:action });
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

<div x-show="showCartPage" class="tw-grid tw-grid-cols-3 tw-gap-10">
  {{-- product details --}}
    <div class="tw-col-span-2">

      {{-- search input --}}
      <div>
        <div class="input-group rounded">
            <input type="search" 
            id="product_search" 
            class="form-control rounded" 
            placeholder="Search Product by Code Or Name" 
            aria-label="Search" 
            aria-describedby="search-addon"
            wire:model.live.debounce.200ms="searchInput"
            />
     
          </div>
      </div>
      {{-- end of search input --}}

    <div class="tw-h-[calc(100vh-16rem)] tw-overflow-scroll">
      <div class="tw-mt-6 tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-gap-4">
        @foreach ($stockItems as $item)
            <div class="card tw-p-4 tw-cursor-pointer tw-text-center" wire:click="addItemsToCart({{ $item->id }})">
                <div class=" tw-w-full tw-h-40 tw-bg-neutral-300 tw-mb-2 tw-overflow-hidden">
                  @if ($item->image)
                      <img class=" tw-w-full tw-h-full" src="{{ asset('storage/attachments/' . $item->image) }}" alt="">
                  @endif
                </div>
                <div class="tw-font-semibold tw-text-black tw-uppercase">{{ $item->item }}</div>
                <div class="tw-text-black">{{ $item->price_per_unit }}</div>
            </div>
        @endforeach
      </div>


    </div>
          
    <div class="tw-mb-8 livewire-pagination">
      {{ $stockItems->links() }}
    </div>


    </div>

    {{-- order details --}}
    <div class="card tw-h-fit">
        <div class="card-content">
            <div class="card-body">

              <div class="tw-flex tw-flex-col tw-gap-5 tw-h-[380px] tw-px-3 tw-overflow-scroll">
                <template x-show="addedItemsRowArr.length > 0" x-for="(row, index) in addedItemsRowArr" :key="index">
                  <div class="tw-bg-neutral-200 tw-p-5 tw-rounded-md tw-relative">
                    <div class="tw-absolute -tw-top-2 -tw-right-2 tw-bg-white tw-p-2 tw-rounded-full">
                      <x-heroicon-o-trash wire:click="removeAddedCartItem(index)" class="tw-w-6 tw-h-6 tw-text-black tw-cursor-pointer"/>
                    </div>
  
                    <div class="tw-flex tw-flex-row tw-justify-between tw-items-center">
                      <div class="tw-flex tw-flex-row tw-gap-3">
                        <div class=" tw-w-16 tw-h-16 tw-bg-neutral-400 tw-rounded-md">
                          <img 
                          x-show="row.image !== null" 
                          x-bind:src="`/storage/attachments/${row.image}`"
                          alt=""
                          class="tw-w-full tw-h-full tw-object-cover tw-rounded-md"
                          >
                        </div>
  
                        <div>
                          <div class="tw-text-black tw-font-semibold tw-uppercase tw-mb-1" x-text="row.item"></div>
                          <div class="tw-font-bold tw-text-rose-700 tw-text-lg"><span>$</span> <span x-text="row.price_per_unit"></span></div>
                        </div>
                      </div>
  
                      <div>
                        <div class="tw-flex tw-flex-row tw-gap-4 tw-justify-center tw-items-center">
                          <x-heroicon-o-minus-circle class="tw-w-8 tw-h-8 tw-text-black tw-cursor-pointer"  @click="toggleItemSellingQuantity(row,index,'decrement')" /> 
                          <span class=" tw-text-neutral-700" x-text="row.selling_quantity"></span>
                          <x-heroicon-o-plus-circle class="tw-w-8 tw-h-8 tw-text-black tw-cursor-pointer" @click="toggleItemSellingQuantity(row,index,'increment')" /> 
                      </div>
                      </div>
                    </div>
                  </div>
                </template>
              </div>

              <hr style="height: 0.1px;">

              <div>
                <div class="tw-flex tw-flex-row tw-justify-between tw-px-3 tw-items-center">
                  <div class="tw-font-bold tw-text-black">Total</div>
                  <div class="tw-font-semibold tw-text-rose-700 tw-text-lg" >$ <span x-text="totalSum"></span></div>
                </div>


                <div class="tw-p-3 tw-mt-2 tw-rounded-md tw-text-center tw-bg-lime-600 tw-text-white tw-cursor-pointer tw-shadow-md" @click="showCartPage=false;">Checkout</div>
              </div>
            </div>
        </div>
    </div>
</div>



<div x-show="showCartPage == false" class="tw-h-full">
  <form wire:submit.prevent="submit" class="tw-w-full">
  <div class="tw-mb-3 tw-p-3 tw-border tw-border-neutral-400 tw-cursor-pointer tw-w-fit tw-rounded-full"  @click="showCartPage=true;">
    <x-heroicon-o-arrow-left class="tw-w-6 tw-h-6 tw-text-black tw-cursor-pointer"/>
  </div>

  <div class="tw-text-black tw-text-3xl tw-font-semibold">Checkout</div>
  <div class="tw-grid tw-grid-cols-2 tw-gap-20">
    {{-- order details --}}
    <div>
      <div class="tw-text-neutral-500 tw-font-bold tw-uppercase tw-mt-3">Order Details</div>
      <hr style="height: 0.1px">
      <div class="tw-flex tw-flex-col tw-gap-5 tw-h-[380px] tw-px-3 tw-overflow-scroll">
        <template x-show="addedItemsRowArr.length > 0" x-for="(row, index) in addedItemsRowArr" :key="index">
          <div class="tw-bg-neutral-200 tw-p-5 tw-rounded-md tw-relative">
            <div class="tw-absolute -tw-top-2 -tw-right-2 tw-bg-white tw-p-2 tw-rounded-full">
              <x-heroicon-o-trash wire:click="removeAddedCartItem(index)" class="tw-w-6 tw-h-6 tw-text-black tw-cursor-pointer"/>
            </div>

            <div class="tw-flex tw-flex-row tw-justify-between tw-items-center">
              <div class="tw-flex tw-flex-row tw-gap-3">
                <div class=" tw-w-16 tw-h-16 tw-bg-neutral-400 tw-rounded-md">
                  <img 
                  x-show="row.image !== null" 
                  x-bind:src="`/storage/attachments/${row.image}`"
                  alt=""
                  class="tw-w-full tw-h-full tw-object-cover tw-rounded-md"
                  >
                </div>

                <div>
                  <div class="tw-text-black tw-font-semibold tw-uppercase tw-mb-1" x-text="row.item"></div>
                  <div class="tw-font-bold tw-text-rose-700 tw-text-lg"><span>$</span> <span x-text="row.price_per_unit"></span></div>
                </div>
              </div>

              <div>
                <div class="tw-flex tw-flex-row tw-gap-4 tw-justify-center tw-items-center">
                  <x-heroicon-o-minus-circle class="tw-w-8 tw-h-8 tw-text-black tw-cursor-pointer"  @click="toggleItemSellingQuantity(row,index,'decrement')" /> 
                  <span class=" tw-text-neutral-700" x-text="row.selling_quantity"></span>
                  <x-heroicon-o-plus-circle class="tw-w-8 tw-h-8 tw-text-black tw-cursor-pointer" @click="toggleItemSellingQuantity(row,index,'increment')" /> 
              </div>
              </div>
            </div>
          </div>
        </template>
      </div>

      <div>
        <div class="tw-flex tw-flex-row tw-justify-between tw-px-3 tw-items-center">
          <div class="tw-font-bold tw-text-black">Total</div>
          <div class="tw-font-semibold tw-text-rose-700 tw-text-lg" >$ <span x-text="totalSum"></span></div>
        </div>
      </div>
    </div>

    {{-- payment details goes here --}}
    <div>
      <div class="tw-text-neutral-500 tw-font-bold tw-uppercase tw-mt-3">Payment Details</div>
      <hr style="height: 0.1px">

      <div class="tw-flex tw-flex-col tw-gap-6 tw-mt-5">
        <div class="tw-grid tw-grid-cols-2 tw-gap-8">
          <div>
            <x-text-input 
            label='Customer name' 
            inputID='customerName' 
            model='customerName' 
            errorMessage={{ $message }} 
            :error="$errors->first('customerName')" 
            ></x-text-input>
          </div>

          <div>
            <x-text-input 
            label='Customer Number' 
            inputID='customerNumber' 
            model='customerNumber' 
            errorMessage={{ $message }} 
            :error="$errors->first('customerNumber')" 
            ></x-text-input>
          </div>
        </div>


        <div>
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

        <div class="tw-grid tw-grid-cols-2 tw-gap-8">
          <x-float-input 
          label='Amount Collected' 
          inputID='amountCollected' 
          model='amountCollected' 
          x_model='amountCollected_x'
          errorMessage={{ $message }} 
          :error="$errors->first('amountCollected')" 
          ></x-float-input>
    
          <div>
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

    <button 
    type="submit"
    class="tw-p-3 tw-w-full tw-mt-10 tw-rounded-md tw-text-center tw-bg-green-600 tw-text-white tw-cursor-pointer tw-shadow-md tw-uppercase">Process payment</button>
    </div>


  </div>
  </form>
</div>

</div>
