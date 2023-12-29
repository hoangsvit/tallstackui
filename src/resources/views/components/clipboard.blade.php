@php
    $text ??= $slot->toHtml();
    $hash = md5($text.uniqid());
    $personalize = $classes();
    $validating($text);
@endphp

<div x-data="tallstackui_clipboard(@js($text), @js($hash), @js($type), @js($placeholders['button']))">
    @if ($type === 'input' && $label)
        <x-label :$label/>
    @endif
    <div @class(['mt-1', 'flex' => $type === 'input'])>
        @if ($type === 'input')
            @if ($left)
                <button data-hash="{{ $hash }}"
                        x-on:click="copy()"
                        @class([$personalize['input.buttons.base'], $personalize['input.buttons.left']])
                        dusk="tallstackui_clipboard_input_copy"
                        type="button">
                    <x-icon :name="$personalize['input.buttons.icon.name']" @class($personalize['input.buttons.icon.class']) />
                    <p x-ref="input-{{ $hash }}">{{ $placeholders['button']['copy'] }}</p>
                </button>
            @endif
            <div @class($personalize['input.wrapper'])>
                <input @if ($secret) type="password" @else type="text" @endif
                       @class([
                            $personalize['input.class.color.base'],
                            $personalize['input.class.color.background'],
                            $personalize['input.class.base'],
                            'rounded-l-md' => ! $left,
                            'rounded-r-md' => $left,
                       ]) value="{{ $text }}" readonly>
            </div>
            @if (! $left)
                <button data-hash="{{ $hash }}"
                        x-on:click="copy()"
                        @class([$personalize['input.buttons.base'], $personalize['input.buttons.right']])
                        dusk="tallstackui_clipboard_input_copy"
                        type="button">
                    <x-icon :name="$personalize['input.buttons.icon.name']" @class($personalize['input.buttons.icon.class']) />
                    <p x-ref="input-{{ $hash }}">{{ $placeholders['button']['copy'] }}</p>
                </button>
            @endif
        @endif
        @if ($type === 'icon')
            <div @class($personalize['icon.wrapper'])>
                <x-icon :name="filled($icons['copy']) ? $icons['copy'] : $personalize['icon.icons.copy.name']"
                        data-hash="{{ $hash }}"
                        @class($personalize['icon.icons.copy.class'])
                        x-on:click="copy()"
                        dusk="tallstackui_clipboard_icon_copy"
                        x-show="!notification" />
                <x-icon :name="filled($icons['copied']) ? $icons['copied'] : $personalize['icon.icons.copied.name']"
                        @class($personalize['icon.icons.copied.class'])
                        x-show="notification" />
            </div>
        @endif
    </div>
    @if ($type === 'input' && $hint)
        <x-hint :$hint/>
    @endif
</div>
