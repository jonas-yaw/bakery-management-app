<div 
x-cloak  
x-data="{ 
    rows: @entangle('rows'),
    currentRow: @entangle('currentRow'),
    currentRowIndex: @entangle('currentRowIndex'),
    showAmendButton: true,
    addRow() {
      this.rows.push({
        search: '',
        item_code: '',
        items: '',
        quantity: '1',
        price_per_unit: '',
        total_amount: '0',
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
    updateEditableState(){
      Livewire.dispatch('updateEditableState');
    },
    get totalSum() {
      return this.rows.reduce((sum, row) => sum + parseFloat(row.total_amount), 0).toFixed(2);
    },
    get totalRowCount() {
        return this.rows.length;
    }
}"
x-init="flatpickr($refs.dateInput, { 
    enableTime: false, 
    dateFormat: 'Y-m-d',
    defaultDate: 'today',
    onChange: function(selectedDates, dateStr) {
        @this.set('quotationDate', dateStr);
    }
})"
style="font-family: 'Nunito'"
>
    <form wire:submit.prevent="submit">

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
        <x-custom-save-btn title="Save" bg_color="tw-bg-sky-600"/>
      </div>   
    @endif

        <div class="main-info">
            <div class="card tw-pt-3" style="height: auto;">
                <div class="card-content">
                    <div class="card-body">
                        <div class="tw-flex tw-flex-col md:tw-grid md:tw-grid-cols-3 tw-gap-6 tw-mb-10">
                            <div class="tw-px-3">
                                {{-- <x-text-input 
                                label='Quotation Date' 
                                inputID='quotationDate' 
                                model='quotationDate' 
                                errorMessage={{ $message }} 
                                :error="$errors->first('quotationDate')" 
                                :disabled="$editStatus == 'uneditable'"
                                ></x-text-input> --}}
                                <label class="tw-block tw-uppercase tw-tracking-wide tw-text-gray-700 tw-font-bold tw-mb-2" for="grid-last-name">
                                    Quotation Date
                                  </label>

                                <input 
                                class="tw-appearance-none tw-block tw-w-full tw-bg-gray-100 tw-text-gray-700 tw-border tw-border-gray-200 tw-rounded tw-py-[9.5px] tw-px-4 tw-leading-tight tw-focus:outline-none tw-focus:bg-white tw-focus:border-gray-500"
                                type="text"  x-ref="dateInput" wire:model.lazy="quotationDate" placeholder="Select a date" class="form-input">
                            </div>
                        </div>

                        <div class="tw-flex tw-flex-col md:tw-grid md:tw-grid-cols-3 tw-gap-6 tw-mb-10">
                            <div class="tw-px-3">
                                <x-text-input 
                                label='Customer Name' 
                                inputID='customerName' 
                                model='customerName' 
                                errorMessage={{ $message }} 
                                :error="$errors->first('customerName')" 
                                :disabled="$editStatus == 'uneditable'"
                                ></x-text-input>
                            </div>

                            <div class="tw-px-3">
                                <x-text-input 
                                label='Mobile Number' 
                                inputID='customerMobileNumber' 
                                model='customerMobileNumber' 
                                errorMessage={{ $message }} 
                                :error="$errors->first('customerMobileNumber')" 
                                :disabled="$editStatus == 'uneditable'"
                                ></x-text-input>
                            </div>

                            <div class="tw-px-3">
                                <x-text-input 
                                label='Address' 
                                inputID='customerAddress' 
                                model='customerAddress' 
                                errorMessage={{ $message }} 
                                :error="$errors->first('customerAddress')" 
                                :disabled="$editStatus == 'uneditable'"
                                ></x-text-input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="sizes-info">
            <div class="card tw-pt-3" style="height: auto;">
                <div class="card-content">
                    <div class="card-body">

                        <div class="tw-px-3 tw-mb-3 tw-text-md">Items</div>
                    
                        <div class="tw-px-3 tw-mb-10">
                            <div class="">
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
                    
                                    <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-px-4 tw-py-1 tw-w-4/12">Item</th>
                                    <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-px-4 tw-text-left tw-py-1 tw-w-2/12">Quantity</th>
                                    <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-px-4 tw-py-1 tw-w-2/12">Price Per Unit</th>
                                    <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-px-4 tw-py-1 tw-w-2/12">Sub Total Amount</th>
                    
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
                                        <div 
                                        x-data="{ 
                                            search: $wire.entangle(`rows.${index}.search`), 
                                            selectedItem: $wire.entangle(`rows.${index}.item`), 
                                            items: $wire.entangle(`rows.${index}.items`), 
                                            showDropdown: false ,
                                            quantity: $wire.entangle(`rows.${index}.quantity`),
                                            price_per_unit: $wire.entangle(`rows.${index}.price_per_unit`),
                                            total_amount: $wire.entangle(`rows.${index}.total_amount`),
                                            updateTotal() {
                                                const qty = parseFloat(this.quantity) || 0;
                                                const price = parseFloat(this.price_per_unit) || 0;
                                                this.total_amount = qty * price;
                                            }
                                        }" 
                                        class="tw-relative tw-w-full">
                                            <input type="text" 
                                            type="text" 
                                            x-model="row.search" 
                                            x-on:input="$wire.call('updateRowSearch', index, row.search)" 
                                            class="tw-w-full tw-bg-white tw-outline-none tw-ring-0 focus:outline-none tw-border-2 tw-border-transparent tw-focus:border-blue-500"  
                                            x-on:focus="showDropdown = true" 
                                            x-on:click.away="showDropdown = false"
                                            >

                                            <div 
                                                x-show="showDropdown && search.length > 0" 
                                                class="tw-absolute tw-bg-white tw-p-1 tw-shadow-md tw-w-full tw-z-50 tw-max-h-48 tw-overflow-auto"
                                                
                                            >
                                                <template x-if="row.items.length > 0">
                                                    <template x-for="item in row.items" :key="item.id">
                                                        <div 
                                                            x-on:click="row.search = item.item;row.item_code = item.code; row.price_per_unit = item.price_per_unit;showDropdown = false;row.total_amount = ((parseFloat(row.quantity) || 0)*(parseFloat(item.price_per_unit) || 0)).toFixed(2) " 
                                                            class="tw-p-2 tw-cursor-pointer hover:tw-bg-gray-100 tw-text-sm"
                                                            x-text="item.item"
                                                        ></div>
                                                    </template>
                                                </template>
                                                <div x-show="row.items.length === 0" class="tw-p-2 tw-text-gray-500">
                                                    No results found.
                                                </div>
                                            </div>

                                        </div>
                                    </td>
        
                                    <td class="tw-border tw-px-4 tw-py-4 tw-w-2/12">
                                        <input type="text" x-model="row.quantity"
                                        class="tw-w-full  tw-bg-white tw-outline-none tw-ring-0 focus:outline-none tw-border-2 tw-border-transparent tw-focus:border-blue-500"  
                                        x-on:input="row.total_amount = ((parseFloat(row.quantity) || 0)*(parseFloat(row.price_per_unit) || 0)).toFixed(2) " 
                                        >
                                    </td>
                                    
                            
                                    <td class="tw-border tw-px-4 tw-py-4 tw-w-1/12">
                                        <input type="text" x-model="row.price_per_unit"
                                            class="tw-w-full  tw-bg-white tw-outline-none tw-ring-0 focus:outline-none tw-border-2 tw-border-transparent tw-focus:border-blue-500"  
                                            @input="row.price_per_unit = formatNumber($event.target.value)"
                                            readonly
                                        >
                                    </td>

                                    <td class="tw-border tw-px-4 tw-py-4 tw-w-1/12">
                                        <input type="text" x-model="row.total_amount"
                                            class="tw-w-full  tw-bg-white tw-outline-none tw-ring-0 focus:outline-none tw-border-2 tw-border-transparent tw-focus:border-blue-500"  
                                            @input="row.total_amount = formatNumber($event.target.value)"
                                            readonly
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

                            <div class="tw-flex-col tw-flex  md:tw-flex-row tw-justify-end tw-mt-4 tw-gap-6">
                                <div class="tw-font-semibold tw-text-lg tw-bg-blue-500 tw-text-white tw-px-4 tw-py-2 tw-rounded-md">Total Items: <span x-text="totalRowCount"></span></div>
                                <div class="tw-font-semibold tw-text-lg tw-bg-blue-500 tw-text-white tw-px-4 tw-py-2 tw-rounded-md">Total Amount: <span x-text="totalSum"></span></div>
                            </div>
                            
                        </div>
        
                    </div>
                </div>
            </div>

        </div> 

        
        
    </form>
</div>