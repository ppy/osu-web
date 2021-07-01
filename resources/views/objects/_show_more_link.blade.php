{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $bn = 'show-more-link';

    $blockClass = class_with_modifiers($bn, $modifiers ?? []);

    if ($hidden ?? false) {
        $blockClass .= ' hidden';
    }

    if (isset($additionalClasses)) {
        $blockClass .= " {$additionalClasses}";
    }

    $arrow ?? ($arrow = 'down');
@endphp
<a
    href="{{ $url }}"
    class="{{ $blockClass }}"
    @foreach ($attributes as $key => $value)
        {{ $key }}="{{ $value }}"
    @endforeach
>
    <span class="{{ $bn }}__spinner">
        {!! spinner() !!}
    </span>
    <span class="{{ $bn }}__label">
        <span class="{{ $bn }}__label-icon">
            <span class="fas fa-angle-{{ $arrow }}"></span>
        </span>
        <span class="{{ $bn }}__label-text">
            {{ osu_trans('common.buttons.show_more') }}
        </span>
        <span class="{{ $bn }}__label-icon">
            <span class="fas fa-angle-{{ $arrow }}"></span>
        </span>
    </span>
</a>
