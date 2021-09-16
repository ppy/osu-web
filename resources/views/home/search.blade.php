{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@php
    $searchMode = $allSearch->getMode();
@endphp
@section('content')
    @include('layout._page_header_v4', ['params' => [
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
                    placeholder="{{ osu_trans('home.search.placeholder') }}"
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

            @if ($searchMode === 'forum_post')
                @include('objects.search._forum_options')
            @endif

            @if ($allSearch->hasQuery())
                @php
                    $showMore = $allSearch->showMore();
                @endphp

                @foreach ($allSearch->visibleSearches() as $mode => $search)
                    @if ($searchMode === 'forum_post')
                        @include('objects.search._forum_sort', compact('search'))
                    @endif

                    @if ($searchMode === 'user')
                        @include('objects.search._user_sort', compact('search'))
                    @endif

                    @include('home._search_results', compact('mode', 'search', 'showMore'))
                @endforeach
            @else
                <div class="search-result">
                    <div class="search-result__row search-result__row--notice">
                        {{ osu_trans('home.search.keyword_required') }}
                    </div>
                </div>
            @endif
        </div>
    </form>
@endsection
