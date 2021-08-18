{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="search-result search-result--{{ $mode }}">
    @if (!auth()->check() && $search->isLoginRequired())
        <div class="search-result__row search-result__row--notice">
            <button class="textual-button textual-button--inline js-user-link">
                {{ osu_trans("home.search.{$mode}.login_required") }}
            </button>
        </div>
    @elseif ($search->getError() !== null)
        <div class="search-result__row search-result__row--notice">
            {{ search_error_message($search->getError()) }}
        </div>
    @elseif ($search->total() === 0)
        <div class="search-result__row search-result__row--notice">
            {{ osu_trans('home.search.empty_result') }}
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
                {{ osu_trans("home.search.{$mode}.more_simple") }}
            </a>
        @else
            @if (request('mode') === 'user' && $search->overLimit())
                <div class="search-result__row search-result__row--notice">
                    {{ osu_trans("home.search.user.more_hidden", ['max' => config("osu.search.max.user")]) }}
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
