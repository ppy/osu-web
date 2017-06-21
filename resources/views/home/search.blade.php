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
    <div class="osu-page">
        <form class="search-header">
            @foreach ($search->urlParams() as $key => $value)
                @if (in_array($key, ['query', 'page', 'limit']))
                    @continue
                @endif

                @if (($value = param_string_simple($value)) === null)
                    @continue
                @endif

                <input type="hidden" name="{{ $key }}" value="{{ param_string_simple($value) }}">
            @endforeach

            <div class="search-header__title">
                {{ trans('home.search.title') }}
            </div>

            <label class="search-header__box">
                <input class="search-header__input" name="query" value="{{ $search->urlParams()['query'] ?? '' }}" />

                <button class="search-header__icon">
                    <i class="fa fa-search"></i>
                </button>
            </label>
        </form>
    </div>

    <div class="osu-page osu-page--small">
        <div class="search">
            <div class="page-mode page-mode--search">
                @foreach ($search::MODES as $mode => $_class)
                    <div class="page-mode__item">
                        <a
                            href="{{ route('search', ['mode' => $mode, 'query' => $search->params['query']]) }}"
                            class="page-mode-link {{ $mode === $search->mode ? 'page-mode-link--is-active' : '' }}"
                        >
                            <span class="fake-bold" data-content="{{ trans("home.search.mode.{$mode}") }}">
                                {{ trans("home.search.mode.{$mode}") }}
                            </span>

                            @if (!$missingQuery && isset($search->search($mode)['total']))
                                <span class="page-mode-link__badge">
                                    {{ search_total_display($search->search($mode)['total']) }}
                                </span>
                            @endif

                            <span class="page-mode-link__stripe u-forum--bg">
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>
            @if ($missingQuery)
                <div>
                    @lang('home.search.missing_query', ['n' => config('osu.search.minimum_length')])
                </div>
            @else
                @include('home._search_results')
            @endif
        </div>
    </div>
@endsection
