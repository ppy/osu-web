{{--
    Copyright 2016 ppy Pty. Ltd.

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
    <div class="osu-layout__row osu-layout__row--page-compact">
        <div class="osu-page-header osu-page-header--live">
                <h1 class="osu-page-header__title">{{ trans('livestreams.top-headers.headline') }}</h1>

                <p class="osu-page-header__title osu-page-header__title--smaller">
                    {{ trans('livestreams.top-headers.description') }}
                </p>
        </div>
    </div>

    @if ($featuredStream !== null)
        <div class="osu-layout__row osu-layout__row--page-compact">
            @include('livestreams._featured', compact('featuredStream'))
        </div>
    @endif

    <div class="osu-layout__row osu-layout__row--page-compact">
        <div class="livestream-page">
            <h2 class="livestream-page__header">
                {{ trans('livestreams.headers.regular') }}
            </h2>

            <div class="livestream-page__items">
                @foreach ($streams as $stream)
                    <div class="livestream-page__item">
                        @include('livestreams._livestream', compact('stream'))
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
