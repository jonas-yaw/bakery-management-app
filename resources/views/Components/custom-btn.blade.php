@props(['title', 'icon' => null, 'bg_color' => 'tw-bg-black', 'text_color' => 'tw-text-white'])

<div class="tw-flex tw-flex-row tw-items-center tw-gap-2 {{ $bg_color }} {{ $text_color }} tw-py-2 tw-px-4 tw-rounded-md tw-cursor-pointer hover:tw-shadow-md">
    @if($icon)
        <x-dynamic-component :component="$icon" class="tw-w-5 tw-h-5 {{ $text_color }}"/>
    @endif
    <div class="tw-text-md">{{ $title }}</div>
</div>

