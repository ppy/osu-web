{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
        {!! $page->get()["output"] !!}
    </div>
@endsection
