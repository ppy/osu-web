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
@extends('master')

@section('content')
    <form action="{{ route('search') }}">
        <input type="hidden" name="mode" value="{{ request('mode') }}">

        <div class="osu-page">
            <div class="search-header">
                <div class="search-header__title">
                    {{ trans('home.search.title') }}
                </div>

                <div class="search-header__box">
                    <input class="search-header__input" name="query" value="{{ request('query') }}" />

                    <button class="search-header__icon">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="osu-page osu-page--small-desktop">
            <div class="search">
                <div class="page-mode page-mode--search">
                    @foreach ($allSearch->searches() as $mode => $search)
                        @php
                            $active = $mode === $allSearch->getMode();
                        @endphp
                        @include('home._search_page_tab', compact('active', 'mode', 'search'))
                    @endforeach
                </div>

                @if ($allSearch->hasQuery())
                    @foreach ($allSearch->visibleSearches() as $mode => $search)
                        @include('home._search_results', compact('mode', 'search'))
                    @endforeach
                @else
                    <div class="search-result">
                        <div class="search-result__row search-result__row--notice">
                            @lang('home.search.missing_query', ['n' => config('osu.search.minimum_length')])
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </form>
@endsection
