@props(['label','inputID','arr' => null,'reference','referenceTwo' => '','model' => null, 'errorMessage' => '', 'error' => null,'x_model' => null,'disabled'=>false])

<div>
    <label class="tw-block tw-uppercase tw-tracking-wide tw-text-gray-700  tw-font-bold tw-mb-2" for="grid-state">
      {{ $label }}
    </label>
    <div class="tw-relative">
      <select class="tw-block tw-appearance-none tw-w-full tw-bg-gray-100 tw-border tw-border-gray-200 tw-text-gray-700 tw-py-[9.5px] tw-px-4 tw-pr-8 tw-rounded tw-leading-tight tw-focus:outline-none tw-focus:bg-white tw-focus:border-gray-500" 
      id="{{ $inputID }}"
      @if($model) 
      wire:model.live="{{ $model }}"
      @endif

      @if($x_model)
          x-model="{{ $x_model }}"
      @endif

      @if($disabled)
        disabled
      @endif 
      >
        @foreach ($arr as $item)
            <option value="{{ $item->{$reference} }}">{{ $item->{$reference} }} 
              @if($referenceTwo)
                - {{ $item->
              {$referenceTwo} }}
            @endif</option>
        @endforeach
      </select>
      <div class="tw-pointer-events-none tw-absolute tw-inset-y-0 tw-right-0 tw-flex tw-items-center tw-px-2 tw-text-gray-700">
        <svg class="tw-fill-current tw-h-4 tw-w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
      </div>
    </div>

    @if($error)
      <div class="tw-text-red-500 tw-text-sm tw-mt-3">{{ $error }}</div>
    @endif
</div>