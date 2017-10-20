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
@extends('master')

@section('content')
    <form action="{{ route('search') }}">
        <input type="hidden" name="mode" value="{{ $search->mode }}">

        <div class="osu-page">
            <div class="search-header">
                <div class="search-header__title">
                    {{ trans('home.search.title') }}
                </div>

                <div class="search-header__box">
                    <input class="search-header__input" name="query" value="{{ $search->urlParams()['query'] ?? '' }}" />

                    <button class="search-header__icon">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="osu-page osu-page--small-desktop">
            <div class="search">
                <div class="page-mode page-mode--search">
                    @foreach ($search::MODES as $mode => $_class)
                        <div class="page-mode__item">
                            <a
                                href="{{ route('search', ['mode' => $mode, 'query' => $search->urlParams()['query'] ?? '']) }}"
                                class="page-mode-link {{ $mode === $search->mode ? 'page-mode-link--is-active' : '' }}"
                            >
                                <span class="fake-bold" data-content="{{ trans("home.search.mode.{$mode}") }}">
                                    {{ trans("home.search.mode.{$mode}") }}
                                </span>

                                @if ($search->hasQuery() && isset($search->search($mode)['total']))
                                    <span class="page-mode-link__badge">
                                        @if ($search->search($mode)['total'] < 100)
                                            {{ $search->search($mode)['total'] }}
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
                @if ($search->mode === 'forum_post')
                    @include('home._search_advanced_forum_post')
                @endif

                @if ($search->hasQuery())
                    @include('home._search_results')
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
