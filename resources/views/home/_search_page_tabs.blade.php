{{--
    Copyright 2015-2018 ppy Pty. Ltd.

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
<div class="page-mode page-mode--search">
    @foreach ($allSearch->searches() as $mode => $search)
        <div class="page-mode__item">
            <a
                href="{{ route('search', ['mode' => $mode, 'query' => request('query')]) }}"
                class="page-mode-link {{ $mode === $allSearch->getMode() ? 'page-mode-link--is-active' : '' }}"
            >
                <span class="fake-bold" data-content="{{ trans("home.search.mode.{$mode}") }}">
                    {{ trans("home.search.mode.{$mode}") }}
                </span>

                @if ($allSearch->hasQuery() && $search !== null)
                    <span class="page-mode-link__badge">
                        @if ($search->count() < 100)
                            {{ $search->count() }}
                        @else
                            99+
                        @endif
                    </span>
                @endif

                <span class="page-mode-link__stripe u-forum--bg">
                </span>
            </a>
        </div>
    @endforeach
</div>
