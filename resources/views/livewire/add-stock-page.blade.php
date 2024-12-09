<div 
x-cloak  
x-data="{ 
    rows: @entangle('rows'),
    currentRow: @entangle('currentRow'),
    currentRowIndex: @entangle('currentRowIndex'),
    itemCategory_x: @entangle('itemCategory'),
    itemBrand_x: @entangle('itemBrand'),
    itemSupplier_x: @entangle('itemSupplier'),
    showAmendButton: true,
    addRow() {
      this.rows.push({
        unit_of_measure: '',
        conversion_factor: '',
        amount: '',
        sizes: [],
      });
    },
    removeRows() {
      this.rows = this.rows.filter((_, index) => !this.checked.includes(index.toString()));
      this.rows = this.rows.filter((_, index) => !this.checked.includes(index));
      this.checked = [];
      this.selectAll = false;
    },

    checked: [],
    selectAll: false,
    showModal: false, 
    getRowSizes(row,index){
        this.currentRow = row;
        this.currentRowIndex = index;
        Livewire.dispatch('updateRowSizes',{ value:this.currentRow });
    },
    updateEditableState(){
      Livewire.dispatch('updateEditableState');
    },
}"
style="font-family: 'Nunito'"
>
    <form wire:submit.prevent="submit" class="tw-w-full tw-h-[calc(100vh-18rem)]">

        @if($status == 'edit') 
        <div class="tw-flex tw-flex-row tw-justify-end tw-gap-3 tw-mb-4">    
      
          <div x-show='showAmendButton' @click="showAmendButton=false;updateEditableState();">
            <x-custom-save-btn title="Amend" type='button'/>
          </div>
      
      
          <div x-show='!showAmendButton' class="tw-flex tw-flex-row tw-gap-3">
            <div @click="showAmendButton=true;updateEditableState();">
              <x-custom-save-btn title="Save" type='submit'/>
            </div>
            
            
            <div @click="showAmendButton=true;updateEditableState();">
              <x-custom-save-btn title="Cancel" type='button' bg_color="tw-bg-neutral-400"/>
            </div>
          </div>
         
          
        </div>
      @endif 

      @if ($status == 'new')
      <div class="tw-flex tw-flex-row tw-justify-end tw-mb-4 tw-px-3">
        <x-custom-save-btn title="Save Item" bg_color="tw-bg-sky-600"/>
      </div>   
    @endif

        <div class="main-info">
            <div class="card tw-pt-3" style="height: auto;">
                <div class="card-content">
                    <div class="card-body">

                        <div class="tw-px-3 tw-mb-10">
                            <input type="file" wire:model="photo" accept="image/*" hidden id="fileInput">
    
                            <!-- Label styled as a button -->
                            @if($status == 'new')
                            <label for="fileInput" class="upload-btn  tw-px-8 tw-py-2 tw-cursor-pointer tw-rounded-md tw-font-semibold tw-bg-neutral-400 tw-text-white">Upload Image</label>
                            @elseif($status == 'edit') 
                            <label x-show='!showAmendButton' for="fileInput" class="upload-btn  tw-px-8 tw-py-2 tw-cursor-pointer tw-rounded-md tw-font-semibold tw-bg-neutral-400 tw-text-white">Change Image</label>
                            @endif 

                            <div class="tw-mt-4">
                                @error('photo') <span class="error tw-text-red-500 tw-font-semibold">{{ $message }}</span> @enderror
                            </div>

                          
                            @if($status != 'new' && is_string($photo))
                                @if ($photo)
                                    <div class="tw-h-44 tw-w-44">
                                        <img src="{{ asset('storage/attachments/' . $photo) }}">
                                    </div>
                                @endif
                            @elseif($photo)
                            <div class="tw-flex tw-flex-col tw-gap-3">   
                                <div class="tw-h-44 tw-w-44">
                                    <img src="{{ $photo->temporaryUrl() }}">
                                </div>
                        
                                <div class="">
                                    <x-heroicon-o-trash wire:click="removePhoto()" class="tw-w-5 tw-h-5 tw-text-black tw-cursor-pointer"/>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="tw-flex tw-flex-col md:tw-grid md:tw-grid-cols-3 tw-gap-6 tw-mb-10">
                            <div class="tw-px-3">
                            <x-select-input 
                            label='Category' 
                            inputID='itemCategory' 
                            :arr="$categories" 
                            reference='type' 
                            model='itemCategory' 
                            x_model='itemCategory_x'
                            errorMessage={{ $message }} 
                            :error="$errors->first('itemCategory')" 
                            :disabled="$editStatus == 'uneditable'"
                            /> 
                            </div>
                    
                            <div class="tw-px-3">
                            <x-text-input 
                            label='Item Name' 
                            inputID='itemName' 
                            model='itemName' 
                            errorMessage={{ $message }} 
                            :error="$errors->first('itemName')" 
                            :disabled="$editStatus == 'uneditable'"
                            ></x-text-input>
                    
                            </div>

                            <div class="tw-px-3">
                                <x-select-input 
                                label='Type' 
                                inputID='itemBrand' 
                                :arr="$brands" 
                                reference='type' 
                                model='itemBrand' 
                                x_model='itemBrand_x'
                                errorMessage={{ $message }} 
                                :error="$errors->first('itemBrand')" 
                                :disabled="$editStatus == 'uneditable'"
                                /> 
                            </div>
                    
                        
                        </div>

                        <div class="tw-flex tw-flex-col md:tw-grid md:tw-grid-cols-3 tw-gap-6 tw-mb-10">
                            <div class="tw-px-3">
                            <x-select-input 
                            label='Supplier' 
                            inputID='itemSupplier' 
                            :arr="$suppliers" 
                            reference='type' 
                            model='itemSupplier' 
                            x_model='itemSupplier_x'
                            errorMessage={{ $message }} 
                            :error="$errors->first('itemSupplier')" 
                            :disabled="$editStatus == 'uneditable'"
                            /> 
                            </div>
                    
                            <div class="tw-px-3">
                            <x-text-input 
                            label='Quantity' 
                            inputID='itemQuantity' 
                            model='itemQuantity' 
                            errorMessage={{ $message }} 
                            :error="$errors->first('itemQuantity')" 
                            :disabled="$editStatus == 'uneditable'"
                            ></x-text-input>
                            </div>

                            <div class="tw-px-3">
                                <x-text-input 
                                label='Restock Limit' 
                                inputID='itemRestockLimit' 
                                model='itemRestockLimit' 
                                errorMessage={{ $message }} 
                                :error="$errors->first('itemRestockLimit')" 
                                :disabled="$editStatus == 'uneditable'"
                                ></x-text-input>
                            </div>
                
                        </div>

                        <div class="tw-flex tw-flex-col md:tw-grid md:tw-grid-cols-3 tw-gap-6 tw-mb-10">
                        {{--     <div>
                            <x-text-input 
                            label='Cost Price' 
                            inputID='itemCostPrice' 
                            model='itemCostPrice' 
                            errorMessage={{ $message }} 
                            :error="$errors->first('itemCostPrice')" 
                            :disabled="$editStatus == 'uneditable'"
                            ></x-text-input>
                            </div> --}}

                            <div class="tw-px-3">
                                <x-text-input 
                                label='Price' 
                                inputID='itemSellingPrice' 
                                model='itemSellingPrice' 
                                errorMessage={{ $message }} 
                                :error="$errors->first('itemSellingPrice')" 
                                :disabled="$editStatus == 'uneditable'"
                                ></x-text-input>
                            </div>
                
                        </div>
        
                    </div>
                </div>
            </div>

        </div>

{{--         <div class="sizes-info">
            <div class="card tw-pt-3" style="height: auto;">
                <div class="card-content">
                    <div class="card-body">

                        <div class="tw-px-3 tw-mb-3 tw-text-md">Sizing & Pricing</div>
                    
                        <div class="tw-px-3 tw-mb-10">
                            <div class=" tw-overflow-auto">
                            <table class="tw-w-full tw-p-2">
                                <thead>
                                <tr>
                                    <th class="tw-border tw-bg-neutral-100 tw-w-1/12 tw-px-4 tw-py-1 tw-text-center">
                                    <input type="checkbox" x-model="selectAll" 
                                    @if ($editStatus == 'uneditable')
                                    disabled
                                    @endif
                                    x-on:change="
                                        checked = selectAll ? rows.map((_, index) => index) : [];
                                    "
                                    >
                                    </th>
                                    <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-w-1/12 tw-px-4 py-1">No.</th>
                    
                                    <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-px-4 tw-py-1 tw-w-4/12">Unit of measure</th>
                                    <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-px-4 tw-text-left tw-py-1 tw-w-2/12">Conversion Factor</th>
                                    <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-px-4 tw-py-1 tw-w-2/12">Selling Price</th>
                    
                                </tr>
                                </thead>
                        
                                <tbody class="tw-text-black">
                                    <tr x-show="rows.length == 0"
                                        class="tw-text-center "
                                        >
                                        <td class="tw-border tw-p-10" colspan="6" rowspan="20">
                                            <div class=" tw-flex tw-flex-col tw-justify-center tw-items-center tw-gap-3">
                                                <x-heroicon-o-document-plus class="tw-w-10 tw-h-8 tw-text-neutral-400 " /> 
                                                <div class="tw-text-neutral-500">No Data</div>
                                            </div>
                                        </td>
                                    </tr>
        
                                <template x-show="rows.length > 0" x-for="(row, index) in rows" :key="index">
                                    <tr>
                                    <td class="tw-border tw-px-4 tw-py-4 tw-w-1/12 tw-text-center">
                                        <input type="checkbox" :value="index" x-model="checked"
                                        x-on:change="
                                            selectAll = (checked.length === rows.length);
                                        "
                                        @if ($editStatus == 'uneditable')
                                        disabled
                                        @endif
                                        >
                                    </td>
                                    <td class="tw-border tw-px-4 tw-py-4 tw-w-1/12" x-text="index + 1"></td>
                                    <td class="tw-border tw-px-4 tw-py-4 tw-w-4/12">
                                        <select x-model="row.unit_of_measure"
                                        @if ($editStatus == 'uneditable')
                                        disabled
                                        @endif
                                        x-on:change="getRowSizes(row,index)"
                                        class="tw-w-full tw-bg-white tw-outline-none tw-ring-0 focus:outline-none tw-border-2 tw-border-transparent tw-focus:border-blue-500"  
                                        >
                                        <option value=""></option>
                                        @foreach ($uoms as $uom)
                                            <option value="{{ $uom }}">{{ $uom }}</option>
                                        @endforeach
                                        </select>
                                    </td>
        
                                    <td class="tw-border tw-px-4 tw-py-4 tw-w-2/12">
                                        <select x-model="row.conversion_factor"
                                        @if ($editStatus == 'uneditable')
                                        disabled
                                        @endif
                                            class="tw-w-full tw-bg-white tw-outline-none tw-ring-0 focus:outline-none tw-border-2 tw-border-transparent tw-focus:border-blue-500"
                                        >
                                        <template x-for="size in row.sizes" :key="size">
                                            <option 
                                            :selected="size === row.conversion_factor"
                                            :value="size" x-text="size"></option>
                                        </template>
                                        
                                        </select>
                                    </td>
                                    
                            
                                    <td class="tw-border tw-px-4 tw-py-4 tw-w-1/12">
                                        <input type="text" x-model="row.amount"
                                            class="tw-w-full  tw-bg-white tw-outline-none tw-ring-0 focus:outline-none tw-border-2 tw-border-transparent tw-focus:border-blue-500"  
                                            @input="row.amount = formatNumber($event.target.value)"
                                            @if ($editStatus == 'uneditable')
                                            disabled
                                            @endif
                                        >
                                    </td>
                                
                                    </tr>
                                </template>
                                </tbody>
                            </table>
                            </div>
                    
                    
                            
                            <div class="tw-flex tw-flex-row tw-mt-5 ">
                                <div x-show="checked.length > 0" x-transition>
                                <button x-on:click="removeRows" type="button"
                                    class="tw-cursor-pointer tw-flex tw-flex-row tw-gap-1 tw-items-center tw-mr-4 tw-rounded tw-bg-red-500 tw-px-6 tw-pb-2 tw-pt-2.5 tw-text-xs tw-font-bold tw-uppercase tw-leading-normal tw-text-white ">
                                    <x-heroicon-o-trash class="tw-w-6 tw-h-4 tw-text-white " /> Remove
                                </button>
                                </div>
                            
                                @if ($editStatus <> 'uneditable')
                                <button x-on:click="addRow" type="button"
                                class="tw-cursor-pointer tw-flex tw-flex-row tw-gap-1 tw-items-center tw-rounded tw-bg-slate-800 tw-px-6 tw-pb-2 tw-pt-2.5 tw-text-xs tw-font-bold tw-uppercase tw-leading-normal tw-text-white ">
                                <x-heroicon-o-plus class="tw-w-6 tw-h-4 tw-text-white " />  Add row
                                </button>
                                @endif
                             
                               
                               
                            </div>
                            
                        </div>
        
                    </div>
                </div>
            </div>

        </div> --}}

        
        
    </form>
</div>