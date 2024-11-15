@props(['title','bg_color' => 'tw-bg-black', 'text_color' => 'tw-text-white','type'=>'submit'])

<button class="{{ $bg_color }} {{ $text_color }} tw-py-2 tw-px-8 tw-rounded-md tw-cursor-pointer hover:tw-shadow-md tw-text-md" 
type="{{ $type }}">{{ $title }}</button>