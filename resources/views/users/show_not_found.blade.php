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
@extends('master', [
    'current_section' => 'community',
    'current_action' => 'profile',
])

@section('content')
    <div class="osu-page osu-page--generic">
        <h1>{{ trans('users.show.not_found.title') }}</h1>

        <p>{{ trans('users.show.not_found.reason_header') }}</p>

        <ul>
            <li>{{ trans('users.show.not_found.reason_1') }}
            <li>{{ trans('users.show.not_found.reason_2') }}
            <li>{{ trans('users.show.not_found.reason_3') }}
        </ul>
    </div>
@endsection
