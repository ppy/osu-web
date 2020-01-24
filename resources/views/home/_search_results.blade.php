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
<div class="search-result search-result--{{ $mode }}">
    @if (!auth()->check() && $search->isLoginRequired())
        <div class="search-result__row search-result__row--notice">
            <button class="textual-button textual-button--inline js-user-link">
                {{ trans("home.search.{$mode}.login_required") }}
            </button>
        </div>
    @elseif ($search->getError() !== null)
        <div class="search-result__row search-result__row--notice">
            {{ search_error_message($search->getError()) }}
        </div>
    @elseif ($search->total() === 0)
        <div class="search-result__row search-result__row--notice">
            {{ trans('home.search.empty_result') }}
        </div>
    @else
        <div class="search-result__row search-result__row--entries-container">
            <div class="search-result__entries">
                @include("home._search_result_{$mode}", compact('search'))
            </div>

            <a
                class="search-result__more-button {{ $showMore ? '' : 'search-result__more-button--hidden' }}"
                href="{{ route('search', ['mode' => $mode, 'query' => request('query')]) }}"
            >
                <span class="fas fa-angle-right"></span>
            </a>
        </div>

        @if ($showMore)
            <a
                class="search-result__row search-result__row--more"
                href="{{ route('search', ['mode' => $mode, 'query' => request('query')]) }}"
            >
                {{ trans("home.search.{$mode}.more_simple") }}
            </a>
        @else
            @if (request('mode') === 'user' && $search->overLimit())
                <div class="search-result__row search-result__row--notice">
                    {{ trans("home.search.user.more_hidden", ['max' => config("osu.search.max.user")]) }}
                </div>
            @endif
            <div class="search-result__row search-result__row--paginator">
                @include('objects._pagination_v2', [
                    'object' => $search->getPaginator(['path' => route('search')])->appends(request()->query()),
                    'modifier' => 'search'
                ])
            </div>
        @endif
    @endif
</div>
