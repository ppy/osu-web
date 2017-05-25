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
@extends('master', ['body_additional_classes' => 'osu-layout--body-dark'])

@section('content')
    <div class="osu-page">
        <div class="osu-page-header osu-page-header--password-reset">
            <h1 class="osu-page-header__title">
                {{ trans('password_reset.title') }}
            </h1>
        </div>
    </div>

    <div class="osu-page osu-page--password-reset">
        @if ($isStarted)
            @include('password_reset._reset')
        @else
            @include('password_reset._initial')
        @endif
    </div>
@endsection
