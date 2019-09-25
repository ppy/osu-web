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
    <div class="osu-layout osu-layout__row">
        <div class="osu-page-header osu-page-header--wiki osu-page-header--wiki-main-page">
            <div class="osu-page-header__title-box">
                <span class="osu-page-header__title osu-page-header__title--icon">
                    <i class="fa fa-university"></i>
                </span>
                <h1 class="osu-page-header__title osu-page-header__title--main">{{ trans('wiki.main.title') }}</h1>
                <h2 class="osu-page-header__title osu-page-header__title--small">{{ trans('wiki.main.subtitle') }}</h2>
            </div>

            @include('wiki._actions')
        </div>
    </div>
    <div class="osu-page osu-page--wiki wiki-main-page">
        @include('wiki._notice')
        @if (Auth::user() !== null)
            <div class="js-react--wiki-search"></div>
        @endif
        {!! $page->page()["output"] !!}
    </div>
@endsection
