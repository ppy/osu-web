{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
            {{ trans('common.buttons.show_more') }}
        </span>
        <span class="{{ $bn }}__label-icon">
            <span class="fas fa-angle-{{ $arrow }}"></span>
        </span>
    </span>
</a>
