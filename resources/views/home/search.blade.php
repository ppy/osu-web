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
@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'section' => trans('home.search.title'),
        'theme' => 'search',
    ]])

    <form
        action="{{ route('search') }}"
        data-loading-overlay="0"
        class="js-search osu-page"
        autocomplete="off"
    >
        <input type="hidden" name="mode" value="{{ request('mode') }}">

        <div class="search-header js-search--header">
            <div class="search-header__box">
                <input
                    class="search-header__input js-search--input"
                    name="query"
                    value="{{ request('query') }}"
                    placeholder="{{ trans('home.search.placeholder') }}"
                    data-search-current="{{ request('query') }}"
                    data-turbolinks-permanent
                    id="search-input"
                    autofocus
                />

                <button class="search-header__icon search-header__icon--normal">
                    <i class="fas fa-search"></i>
                </button>

                <button class="search-header__icon search-header__icon--searching">
                    {!! spinner() !!}
                </button>
            </div>
        </div>

        <div class="search">
            @include('home._search_page_tabs', compact('allSearch'))

            @if ($allSearch->getMode() === 'forum_post')
                @include('objects.search._forum_options')
            @endif

            @if ($allSearch->hasQuery())
                @php
                    $showMore = $allSearch->showMore();
                @endphp
                @foreach ($allSearch->visibleSearches() as $mode => $search)
                    @include('home._search_results', compact('mode', 'search', 'showMore'))
                @endforeach
            @else
                <div class="search-result">
                    <div class="search-result__row search-result__row--notice">
                        {{ trans('home.search.keyword_required') }}
                    </div>
                </div>
            @endif
        </div>
    </form>
@endsection
