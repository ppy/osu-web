{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<label class="{{ class_with_modifiers('osu-switch-v2', $modifiers ?? []) }}">
    @if (isset($defaultValue))
        <input
            type="hidden"
            @if (isset($name))
                name="{{ $name }}"
            @endif
            value="{{ $defaultValue }}"
        />
    @endif
    <input
        class="osu-switch-v2__input {{ $additionalClass ?? '' }}"
        type="{{ $type ?? 'checkbox' }}"
        @if (isset($name))
            name="{{ $name }}"
        @endif
        @if (isset($value))
            value="{{ $value }}"
        @endif
        @if ($checked ?? false)
            checked
        @endif
        @foreach ($attributes ?? [] as $k => $v)
            {!! $k !!}="{{ $v }}"
        @endforeach
    />
    <span class="osu-switch-v2__content"></span>
</label>
