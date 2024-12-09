@props(['label','inputID','placeholder','type' => 'text',
'model' => null, 'errorMessage' => '', 'error' => null,
'x_model' => null,'disabled'=>false,'linkedInput' => false,
'x_on_click' => null,'model_on_click'=>null,
'input_bg'=>'tw-bg-gray-100',
'input_border_color'=>'tw-border-gray-200'
])

<div class="tw-w-full tw-md:w-1/3">
    <div>
        <label class="tw-block tw-uppercase tw-tracking-wide tw-text-gray-700 tw-font-bold tw-mb-2" for="grid-last-name">
            {{ $label }}
          </label>
          <div class="tw-relative">
            <input 
            class="tw-appearance-none tw-block tw-w-full {{ $input_bg }} tw-text-gray-700 tw-border {{ $input_border_color }} tw-rounded tw-py-[9.5px] tw-px-4 tw-leading-tight tw-focus:outline-none tw-focus:bg-white tw-focus:border-gray-500" 
            id="{{ $inputID }}" 
            type="{{ $type }}" 
            placeholder=""
            @if($model) wire:model.live.debounce.200ms="{{ $model }}" @endif

            @if($x_model)
             x-model="{{ $x_model }}"
            @endif

            @if($disabled)
              disabled
            @endif 
            
            >
            @if($linkedInput)
            <div class="tw-absolute tw-inset-y-0 tw-right-3 tw-flex tw-items-center"
            @if(!$disabled && $model_on_click)
             wire:click="{{ $model_on_click }}"
            @endif 

            @if ($x_on_click)
              x-on:click="{{ $x_on_click }}"
            @endif
            >
              <x-heroicon-o-arrow-right class=" tw-w-6 tw-h-4 tw-text-black tw-cursor-pointer"
                
              />
            </div>
            @endif 
          </div>
       
            @if($error)
              <div class="tw-text-red-500 tw-text-sm tw-mt-3">{{ $error }}</div>
            @endif
    </div>
</div>
