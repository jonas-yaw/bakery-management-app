@props(['filtername','placeholder','wireFilterName'])
<div>
    <input 
    class="tw-bg-neutral-200 tw-rounded-md tw-px-3 tw-py-2 tw-outline-none tw-ring-0"
    type="text" name="{{ $filtername }}" id="{{ $filtername }}" placeholder="{{ $placeholder }}"
    wire:model.live.debounce.250ms="{{ $wireFilterName }}"
    >
</div>