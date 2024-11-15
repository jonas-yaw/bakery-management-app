@props(['label','x_model' => null,'model' => null])

<div class="tw-w-full tw-md:w-1/3 tw-px-3">
    <div>
        <label class="tw-block tw-uppercase tw-tracking-wide tw-text-gray-700 tw-font-bold tw-mb-2" for="grid-last-name">
            {{ $label }}
          </label>
          <input 
          type="date" 
          @if($model) wire:model.live.debounce.200ms="{{ $model }}" @endif
          @if($x_model)
             x-model="{{ $x_model }}"
            @endif
          class="tw-appearance-none tw-block tw-w-full tw-bg-gray-100 tw-text-gray-700 tw-border tw-border-gray-200 tw-rounded tw-py-[9.5px] tw-px-4 tw-leading-tight tw-focus:outline-none tw-focus:bg-white tw-focus:border-gray-500"
          >
    </div>
  </div>