{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $additionalClass = $locals['additionalClass'] ?? '';
    $attributes = $locals['attributes'] ?? [];
    $checked = $locals['checked'] ?? false;
    $defaultValue = $locals['defaultValue'] ?? null;
    $modifiers = $locals['modifiers'] ?? null;
    $name = $locals['name'] ?? null;
    $type = $locals['type'] ?? 'checkbox';
    $value = $locals['value'] ?? null;
@endphp
<label class="{{ class_with_modifiers('osu-switch-v2', $modifiers) }}">
    @if ($defaultValue !== null)
        <input
            type="hidden"
            @if (isset($name))
                name="{{ $name }}"
            @endif
            value="{{ $defaultValue }}"
        />
    @endif
    <input
        class="osu-switch-v2__input {{ $additionalClass }}"
        type="{{ $type }}"
        @if ($name !== null)
            name="{{ $name }}"
        @endif
        @if ($value !== null)
            value="{{ $value }}"
        @endif
        @if ($checked)
            checked
        @endif
        @foreach ($attributes as $k => $v)
            {!! $k !!}="{{ $v }}"
        @endforeach
    />
    <span class="osu-switch-v2__content"></span>
</label>
