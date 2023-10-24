@php
    $tag = $href ? 'a' : 'button';
    $customize = tallstackui_personalization('button.circle', $personalization());

    $sizes['wrapper'] = $customize['wrapper.sizes.' . $size];
    $sizes['icon'] = $customize['icon.sizes.' . $size];
    $sizes['text'] = $customize['text.sizes.' . $size];
@endphp

<{{ $tag }} @if ($href) href="{{ $href }}" @else
    role="button"
@endif {{ $attributes->class([
            $customize['wrapper.base'],
            $sizes['wrapper'],
            $colors['wrapper.color']
        ]) }} wire:loading.attr="disabled" wire:loading.class="!cursor-wait">
@if ($icon)
    @if ($loading)
        @if ($delay === 'longest')
            <x-icon :$icon @class([$sizes['icon'], $colors['icon.color']]) wire:loading.remove.delay.longest />
        @elseif ($delay === 'longer')
            <x-icon :$icon @class([$sizes['icon'], $colors['icon.color']]) wire:loading.remove.delay.longer />
        @elseif ($delay === 'long')
            <x-icon :$icon @class([$sizes['icon'], $colors['icon.color']]) wire:loading.remove.delay.long />
        @elseif ($delay === 'short')
            <x-icon :$icon @class([$sizes['icon'], $colors['icon.color']]) wire:loading.remove.delay.short />
        @elseif ($delay === 'shorter')
            <x-icon :$icon @class([$sizes['icon'], $colors['icon.color']]) wire:loading.remove.delay.shorter />
        @elseif ($delay === 'shortest')
            <x-icon :$icon @class([$sizes['icon'], $colors['icon.color']]) wire:loading.remove.delay.shortest />
        @else
            <x-icon :$icon @class([$sizes['icon'], $colors['icon.color']]) wire:loading.remove />
        @endif
    @else
        <x-icon :$icon @class([$sizes['icon'], $colors['icon.color']]) />
    @endif
@else
    <span @if ($loading) wire:loading.remove @endif @class([$sizes['text']])>{{ $text ?? $slot }}</span>
@endif
@if ($loading)
    <x-tallstack-ui::icon.others.loading-button :$loading :$delay @class([
        'animate-spin',
        $sizes['icon'],
        $colors['icon.loading.color']
    ]) />
@endif
</{{ $tag }}>