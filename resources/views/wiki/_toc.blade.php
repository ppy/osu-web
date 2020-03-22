{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
