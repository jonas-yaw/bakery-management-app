<div 
 style="font-family: 'Nunito'"
x-cloak 
x-init="$watch('selectPage', value => selectPageUpdated(value))" 
x-data="{
    paymentsCurrent: @entangle('paymentsInPage'),
    sortField: @entangle('sortField'),
    sortDirection: @entangle('sortDirection'),
    selectPage: false,
    checked: [],
    showActionDropDown: false,
    openSortFieldDropDown: false,
    confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('deleteRecord', { checkedItems: this.checked });
                this.clearChecked();
            }
        });
    },
    clearChecked() {
        this.checked = [];
    },
    selectPageUpdated(value) {
        if (value) {
            this.checked = this.paymentsCurrent;
        } else {
            this.checked = [];
        }
    },
    exportSelected(){
        Livewire.dispatch('exportSelected', { checked: this.checked });
    }
}"
class="tw-text-black"
>
    <div class="tw-flex tw-flex-row tw-justify-end tw-gap-3">

        
        <div x-show="checked.length > 0" class="tw-relative tw-w-48 tw-mb-3" x-transition>
            <div class="tw-flex tw-flex-row tw-justify-end">
                <div @click="showActionDropDown = ! showActionDropDown"  class=" tw-w-fit tw-flex tw-flex-row tw-items-center tw-gap-2 tw-bg-black tw-text-white tw-py-2 tw-px-4 tw-rounded-md tw-cursor-pointer hover:tw-shadow-md">
                    <div class=" tw-font-semibold">Actions</div>
                    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
                        <x-heroicon-o-chevron-up class="tw-w-4 tw-h-2 tw-text-white"/>
                        <x-heroicon-o-chevron-down class="tw-w-4 tw-h-2 tw-text-white"/>
                    </div>
                </div>  
            </div>

            <div x-show="showActionDropDown"
             @click.outside="showActionDropDown = false" class="tw-absolute tw-w-full tw-top-12 tw-bg-white tw-shadow-xl tw-border tw-border-neutral-200 tw-rounded-md tw-p-2 tw-z-50"
             x-transition:enter="tw-transition tw-duration-200 tw-ease-out"
             x-transition:enter-start="tw-opacity-0 tw-scale-90"
             x-transition:enter-end="tw-opacity-100 tw-scale-100"
             x-transition:leave="tw-transition tw-duration-150 tw-ease-in"
             x-transition:leave-start="tw-opacity-100 tw-scale-100"
             x-transition:leave-end="tw-opacity-0 tw-scale-90"
             >
                <div>
                    <div class="tw-pr-4 tw-pl-2 tw-py-2 hover:tw-bg-neutral-100 tw-rounded-md tw-cursor-pointer"  @click="exportSelected">Export</div>
                    {{-- <div class="tw-pr-4 tw-pl-2 tw-py-2 hover:tw-bg-neutral-100 tw-rounded-md tw-cursor-pointer" @click="confirmDelete">Delete</div> --}}
                </div>
            </div>
        </div>
      
   </div>


    <div class="tw-border tw-border-neutral-200 tw-rounded-md  tw-p-5 tw-flex tw-flex-col tw-justify-between tw-content-max-height">
        <div>
            <div class="tw-grid tw-grid-cols-6 tw-mt-2">
                <div class=" tw-col-span-4 tw-flex tw-flex-row tw-flex-wrap tw-gap-3">  
                    <x-filter-input filtername='receipt_number_filter' placeholder='Receipt #' wireFilterName='receiptNumberFilter'></x-filter-input>
                    <x-filter-input filtername='collection_mode_filter' placeholder='Collection mode' wireFilterName='collectionModeFilter'></x-filter-input>
                    <x-filter-input filtername='product_filter' placeholder='Item' wireFilterName='productFilter'></x-filter-input>
                    <x-filter-input filtername='category_filter' placeholder='Category' wireFilterName='categoryFilter'></x-filter-input>
                       
                </div>
    
                <div class=" tw-col-span-2 tw-flex tw-flex-row tw-flex-wrap tw-justify-end tw-gap-5">


                    <div  class="tw-flex tw-flex-row tw-items-center tw-gap-1 tw-bg-neutral-200 tw-py-2 tw-px-2 tw-rounded-md tw-cursor-pointer">

                        @if ($sortDirection == 'asc')
                        <x-heroicon-o-bars-arrow-down wire:click.debounce.100ms="changeSortDirection()" class="tw-w-8 tw-h-5 tw-text-black tw-border-r tw-border-r-neutral-500  tw-pr-2"/>
                        @else 
                        <x-heroicon-o-bars-arrow-up  wire:click.debounce.100ms="changeSortDirection()" class="tw-w-8 tw-h-5 tw-text-black tw-border-r tw-border-r-neutral-500  tw-pr-2"/>

                        @endif

                        <div>
                            <div @click="openSortFieldDropDown = ! openSortFieldDropDown" @click.outside="openSortFieldDropDown = false"  class=" tw-px-2">{{ $sortFieldName }}</div>
                            <div x-transition  x-show="openSortFieldDropDown" class=" tw-absolute tw-bg-white tw-rounded-md tw-shadow-lg tw-w-48 tw-top-44 tw-right-9 tw-px-1 tw-py-3">
                                <ul class="tw-flex tw-flex-col tw-gap-1 ">
                                    {{-- <li class=" hover:tw-bg-neutral-200 tw-cursor-pointer tw-rounded-md tw-px-3 tw-py-1" wire:click="changeSortField('id')">ID</li> --}}
                                    <li class=" hover:tw-bg-neutral-200 tw-cursor-pointer tw-rounded-md tw-px-3 tw-py-1" wire:click="changeSortField('created_on','Created On')">Created On</li>
                                    <li class=" hover:tw-bg-neutral-200 tw-cursor-pointer tw-rounded-md tw-px-3 tw-py-1" wire:click="changeSortField('receipt_number','Receipt Number')">Receipt #</li>
                                    <li class=" hover:tw-bg-neutral-200 tw-cursor-pointer tw-rounded-md tw-px-3 tw-py-1" wire:click="changeSortField('product','Item')">Item</li>
                                    <li class=" hover:tw-bg-neutral-200 tw-cursor-pointer tw-rounded-md tw-px-3 tw-py-1" wire:click="changeSortField('brand','Brand')">Brand</li>
                                    <li class=" hover:tw-bg-neutral-200 tw-cursor-pointer tw-rounded-md tw-px-3 tw-py-1" wire:click="changeSortField('category','Category')">Category</li>
                                    
                                    <li class=" hover:tw-bg-neutral-200 tw-cursor-pointer tw-rounded-md tw-px-3 tw-py-1" wire:click="changeSortField('created_by','Created By')">Created By</li>
                                </ul>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>
    
    
            <div class="tw-mt-8 tw-overflow-y-auto tw-h-[360px]">
                <table class="tw-w-full ">
                    <thead>
                        <tr class=" tw-bg-neutral-200 tw-py-2 tw-rounded-full tw-text-black">
                            <th class="tw-p-3"><input type="checkbox" x-model="selectPage"></th>
                            <th class="tw-text-center tw-p-2 tw-font-semibold">Receipt #</th>
                            <th class="tw-text-center tw-p-2 tw-font-semibold">Item</th>
                            <th class="tw-text-center tw-p-2 tw-font-semibold">Category</th>
                            <th class="tw-text-center tw-p-2 tw-font-semibold">Type</th>
                            <th class="tw-text-center tw-p-2 tw-font-semibold">Amount</th>
                            <th class="tw-text-center tw-p-2 tw-font-semibold">Collection Mode</th>
                            <th class="tw-text-center tw-p-2 tw-font-semibold">Quantity</th>
                            <th class="tw-text-center tw-p-2 tw-font-semibold">Date & Time</th>
                            <th class="tw-text-center tw-p-2 tw-font-semibold">Created By</th>
                            {{-- <th></th> --}}
                        </tr>
                    </thead>

                    <tbody style="font-size: 15px;">
                        @foreach( $payments as $key => $item )
                        <tr class="tw-text-black tw-border-b tw-border-b-neutral-200 tw-cursor-pointer hover:tw-bg-neutral-100">
                            <td class="tw-p-3"><input type="checkbox" value="{{ $item->id }}" x-model="checked"></td>
                            <td class="tw-text-center hover:tw-underline">
                                <a class="tw-text-black hover:tw-text-black" href="/print-receipt/{{ Crypt::encrypt($item->receipt_number) }}">
                                    {{ $item->receipt_number }}
                                </a>
                            </td>
                            <td class="tw-text-center">{{ ucwords(strtolower(Str::limit($item->product,50))) }}</td>
                            <td class="tw-text-center">{{ $item->category }}</td>
                            <td class="tw-text-center">{{ $item->brand }}</td>
                            <td class="tw-text-center">{{ $item->amount_paid }}</td>
                            <td class="tw-text-center">{{ $item->collection_mode }}</td>
                            <td class="tw-text-center">{{ $item->quantity }}</td>
                            <td class="tw-text-center">{{ $item->receipt_date }}</td>
                            
                            <td class="tw-text-center">{{ $item->created_by }}</td>
                            {{-- <td><a href="/print-receipt/{{ Crypt::encrypt($item->receipt_number) }}"><x-heroicon-o-document-text class="tw-w-5 tw-h-5 tw-text-black " /> </a></td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-footer tw-h-1/6 tw-mt-10">
            <div class="tw-flex tw-flex-row tw-w-fit border tw-border-neutral-200 tw-rounded-md tw-overflow-hidden">
                <div class="tw-border-r tw-border-r-neutral-200 tw-px-4 tw-py-1 tw-cursor-pointer hover:tw-bg-neutral-300" wire:click="setPaginate(20)">20</div>
                <div class="tw-border-r tw-border-r-neutral-200 tw-px-4 tw-py-1 tw-cursor-pointer hover:tw-bg-neutral-300" wire:click="setPaginate(50)">50</div>
                <div class="tw-border-r tw-border-r-neutral-200 tw-px-4 tw-py-1 tw-cursor-pointer hover:tw-bg-neutral-300" wire:click="setPaginate(100)">100</div>
                <div class="tw-px-4 tw-py-1 tw-cursor-pointer hover:tw-bg-neutral-300" wire:click="setPaginate(200)">200</div>
            </div>
        </div>
       </div>
</div>

