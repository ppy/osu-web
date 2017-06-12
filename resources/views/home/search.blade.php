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
        <div class="search-header">
            <div class="search-header__title">
                {{ trans('home.search.title') }}
            </div>

            <label class="search-header__box">
                <input class="search-header__input" name="query" value="{{ $search->params['query'] ?? '' }}" />

                <span class="search-header__icon">
                    <i class="fa fa-search"></i>
                </span>
            </label>
        </div>
    </div>

    <div class="osu-page osu-page--small">
        <div class="search">
            <div class="page-mode page-mode--search">
                @foreach (App\Libraries\Search::MODES as $mode)
                    <div class="page-mode__item">
                        <a
                            href="{{ $search->url(['mode' => $mode]) }}"
                            class="page-mode-link {{ $mode === $search->mode ? 'page-mode-link--is-active' : '' }}"
                        >
                            <span class="fake-bold" data-content="{{ trans("home.search.mode.{$mode}") }}">
                                {{ trans("home.search.mode.{$mode}") }}
                            </span>

                            <span class="page-mode-link__stripe u-forum--bg">
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>
            hi
        </div>
    </div>
@endsection
