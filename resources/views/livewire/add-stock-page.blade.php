<div 
x-cloak  
x-data="{ 
    rows: @entangle('rows'),
    payment_mode_model: @entangle('paymentMode'),
    addRow() {
      this.rows.push({
        loan_security_name: '',
        loan_security_quantity: '',
        loan_security_price: '',
        loan_security_amount: ''
      });
    },
    removeRows() {
      this.rows = this.rows.filter((_, index) => !this.checked.includes(index.toString()));
      this.rows = this.rows.filter((_, index) => !this.checked.includes(index));
      this.checked = [];
      this.selectAll = false;
    },
    editRow(row) {
      this.currentRow = row;
      this.showModal = true;
    },
    checked: [],
    selectAll: false,
    showModal: false, 
    calculateLoanSecurityTotalAmount(row) {
      if (row.loan_security_quantity && row.loan_security_price) {
          row.loan_security_amount = row.loan_security_quantity*row.loan_security_price;
      } else {
          row.nights = 1;
      }
    },
}"
style="font-family: 'Nunito'"
>
    <div class="main-info">
        <div class="card tw-pt-3" style="height: auto;">
            <div class="card-content">
                <div class="card-body">

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
                
                        <div>
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
                            label='Brand' 
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
                
                        <div>
                        <x-text-input 
                        label='Quantity' 
                        inputID='itemQuantity' 
                        model='itemQuantity' 
                        errorMessage={{ $message }} 
                        :error="$errors->first('itemQuantity')" 
                        :disabled="$editStatus == 'uneditable'"
                        ></x-text-input>
                        </div>

                        <div>
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
                        <div>
                        <x-text-input 
                        label='Cost Price' 
                        inputID='itemCostPrice' 
                        model='itemCostPrice' 
                        errorMessage={{ $message }} 
                        :error="$errors->first('itemCostPrice')" 
                        :disabled="$editStatus == 'uneditable'"
                        ></x-text-input>
                        </div>

                        <div>
                            <x-text-input 
                            label='Selling Price' 
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

    <div class="sizes-info">
        <div class="card tw-pt-3" style="height: auto;">
            <div class="card-content">
                <div class="card-body">

                    <div>Sizing & Pricing</div>
                
                    <div class="tw-px-3 tw-mb-10">
                        <div class=" tw-overflow-auto">
                          <table class="tw-w-full tw-p-2">
                            <thead>
                              <tr>
                                <th class="tw-border tw-bg-neutral-100 tw-w-1/12 tw-px-4 tw-py-1 tw-text-center">
                                  <input type="checkbox" x-model="selectAll" 
                                  x-on:change="
                                    checked = selectAll ? rows.map((_, index) => index) : [];
                                  "
                                >
                                </th>
                                <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-w-1/12 tw-px-4 py-1">No.</th>
                
                                <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-px-4 tw-py-1 tw-w-4/12">Loan Security</th>
                                <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-px-4 tw-text-left tw-py-1 tw-w-2/12">Quantity</th>
                                <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-text-left tw-px-4 tw-py-1 tw-w-2/12">Loan Security Price</th>
                                <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-text-right tw-px-4 tw-py-1 tw-w-2/12">Amount</th>
                
                                {{-- <th class="tw-border tw-uppercase tw-tracking-wide tw-text-sm tw-font-semibold tw-bg-neutral-100 tw-px-4 tw-py-1"></th> --}}
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
                                    >
                                  </td>
                                  <td class="tw-border tw-px-4 tw-py-4 tw-w-1/12" x-text="index + 1"></td>
                                  <td class="tw-border tw-px-4 tw-py-4 tw-w-4/12">
                                    <input type="text" x-model="row.loan_security_name"
                                        class="tw-w-full tw-bg-white tw-outline-none tw-ring-0 focus:outline-none tw-border-2 tw-border-transparent tw-focus:border-blue-500"  
                                    >
                                  </td>
    
                                  <td class="tw-border tw-px-4 tw-py-4 tw-w-2/12">
                                    <input type="text" x-model="row.loan_security_quantity"
                                        class="tw-w-full tw-bg-white tw-outline-none tw-ring-0 focus:outline-none tw-border-2 tw-border-transparent tw-focus:border-blue-500"
                                        @input="row.loan_security_quantity = formatNumber($event.target.value)"
                                        @change="calculateLoanSecurityTotalAmount(row)"
                                    >
                                  </td>
                                
                                  
                                  <td class="tw-border tw-px-4 tw-py-4 tw-w-2/12">
                                    <input type="text" x-model="row.loan_security_price"
                                        class="tw-w-full tw-text-left tw-bg-white tw-outline-none tw-ring-0 focus:outline-none tw-border-2 tw-border-transparent tw-focus:border-blue-500"  
                                        @input="row.loan_security_price = formatNumber($event.target.value)"
                                        @change="calculateLoanSecurityTotalAmount(row)"
                                    >
                                  </td>
    
                                  <td class="tw-border tw-px-4 tw-py-4 tw-w-1/12">
                                    <input type="text" x-model="row.loan_security_amount"
                                        class="tw-w-full tw-text-right tw-bg-white tw-outline-none tw-ring-0 focus:outline-none tw-border-2 tw-border-transparent tw-focus:border-blue-500"  
                                        readonly
                                    >
                                  </td>
                              
                                 
                                {{--   <td class="tw-border tw-px-4 tw-py-4">
                                    <x-heroicon-o-pencil class="tw-w-6 tw-h-4 tw-text-black tw-cursor-pointer"
                                        x-on:click="editRow(row)"
                                    />
                                  </td> --}}
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
                        
                            <button x-on:click="addRow" type="button"
                                class="tw-cursor-pointer tw-flex tw-flex-row tw-gap-1 tw-items-center tw-rounded tw-bg-slate-800 tw-px-6 tw-pb-2 tw-pt-2.5 tw-text-xs tw-font-bold tw-uppercase tw-leading-normal tw-text-white ">
                                <x-heroicon-o-plus class="tw-w-6 tw-h-4 tw-text-white " />  Add row
                            </button>
                          </div>
                        
                    </div>
      
                </div>
            </div>
        </div>

    </div>
</div>
