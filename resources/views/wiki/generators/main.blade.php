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
$lastLevel = 1;
@endphp

@foreach ($elements as $element)
    @if ($element["level"] === 1)
        @if ($lastLevel > 1)
            </div></div>
        @endif

        <div class="wiki-main-page-panel">
            <div class="wiki-main-page-panel__title">
                @if (array_key_exists("url", $element))
                    <a href="{{ $element['url'] }}">{{ $element["text"] }}</a>
                @else
                    {{ $element["text"] }}
                @endif
            </div>
            <div class="wiki-main-page-panel__links">
    @elseif ($element["level"] >= 2)
        @if ($element["level"] === 3 && $lastLevel === 2)
            <span class="wiki-main-page-panel__sublinks">
        @elseif ($element["level"] === 2 && $lastLevel === 3)
            </span>
        @endif

        @if (array_key_exists("url", $element))
            <span class="wiki-main-page-panel__link"><a href="{{ $element['url'] }}">{{ $element["text"] }}</a></span>
        @else
            <span class="wiki-main-page-panel__link">{{ $element["text"] }}</span>
        @endif
    @endif

    @php
    $lastLevel = $element["level"]
    @endphp
@endforeach
