@props(['name','bg_color'=>'tw-bg-neutral-100','is_color_coded'=>null,'model_on_click'=>null])

<div class="tw-flex tw-flex-row tw-gap-1">
    @if ($is_color_coded)
    <div class="tw-w-5 tw-h-5 tw-rounded-sm {{ $bg_color }}"></div>
    @endif
    
    <input type="checkbox" class="tw-w-5 tw-h-5"
    @if ($model_on_click == 'roomStatus')
        wire:click="addRoomStatusFilter('{{ $name }}')"
    @elseif($model_on_click == 'roomOccupancy')
        wire:click="addOccupancyStatusFilter('{{ $name }}')"
    @elseif($model_on_click == 'roomReservation')
        wire:click="addReservationStatus('{{ $name }}')"
    @elseif($model_on_click == 'evenRoom')
        wire:click="addEvenRoomStatus('{{ $name }}')"
    @endif
    >
    <div>{{ $name }}</div>
</div>