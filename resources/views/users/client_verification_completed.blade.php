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
@php
$type = 'client';
@endphp

@extends('users._verify')

@section('user-verification-box')
    <div class="user-verification">
        <h1 class="user-verification__row user-verification__row--title">{{ trans('user_verification.box.title.client') }}</h1>

        <h1 class="user-verification__row user-verification__row--title user-verification__row--success">
            <span class="fa fa-check"></span>
        </h1>

        <p class="user-verification__row">
            {!! trans('user_verification.box.client_success', [
                'home_link' => link_to_route(
                    'home',
                    trans('user_verification.box.info.home_link'),
                    [],
                    ['class' => 'user-verification__link'])]
                )
            !!}
        </p>
    </div>
@endsection
