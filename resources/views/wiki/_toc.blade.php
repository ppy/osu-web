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
    $currentLevels = [0];
@endphp
@foreach ($page->get()['toc'] as $id => $header)
    {{--
        closes previous <ol> tags until the level balances
    --}}
    @while ($header['level'] < array_last($currentLevels))
        @php
            array_pop($currentLevels);
        @endphp
        </ol>
    @endwhile

    @if ($header['level'] > array_last($currentLevels))
        @php
            $currentLevels[] = $header['level'];
        @endphp
        <ol class="wiki-toc-list {{ count($currentLevels) > 2 ? '' : 'wiki-toc-list--top' }}">
    @endif

    {{--
        reminder that <li> doesn't need closing tag
    --}}
    <li class="wiki-toc-list__item">
        <a
            href="#{{ $id }}"
            class="wiki-toc-list__link {{ $header['level'] <= 2 ? '' : 'wiki-toc-list__link--small' }}"
        >
            {{ $header['title'] }}
        </a>

    @if ($loop->last)
        @foreach ($currentLevels as $level)
            @if ($level === 0)
                @break
            @endif
            </ol>
        @endforeach
    @endif
@endforeach
