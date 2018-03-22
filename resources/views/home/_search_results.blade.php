{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
<div class="search-result search-result--{{ $mode }}">
    @if ($search->total() === 0)
        <div class="search-result__row search-result__row--notice">
            @lang('home.search.empty_result')
        </div>
    @else
        <div class="search-result__row search-result__row--entries-container">
            <div class="search-result__entries">
                @include("home._search_result_{$mode}", compact('search'))
            </div>

            <a
                class="search-result__more-button {{ $showMore ? 'search-result__more-button--hidden' : '' }}"
                href="{{ route('search', ['mode' => $mode, 'query' => request('query')]) }}"
            >
                <span class="fa fa-angle-right"></span>
            </a>
        </div>

        @if (request('mode') === 'all')
            <a
                class="search-result__row search-result__row--more"
                href="{{ route('search', ['mode' => $mode, 'query' => request('query')]) }}"
            >
                @lang("home.search.{$mode}.more_simple")
            </a>
        @else
            <div class="search-result__row search-result__row--paginator">
                @php
                    $paginator = $search->getPaginator(['path' => route('search')])->appends(request()->query());
                @endphp
                @include('objects._pagination', ['object' => $paginator, 'modifier' => 'search'])
            </div>
        @endif
    @endif
</div>
