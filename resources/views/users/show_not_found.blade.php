{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @include('layout._page_header_v4')
    <div class="osu-page osu-page--generic">
        <h1>{{ osu_trans('users.show.not_found.title') }}</h1>

        <p>{{ osu_trans('users.show.not_found.reason_header') }}</p>

        <ul>
            <li>{{ osu_trans('users.show.not_found.reason_1') }}
            <li>{{ osu_trans('users.show.not_found.reason_2') }}
            <li>{{ osu_trans('users.show.not_found.reason_3') }}
        </ul>
    </div>
@endsection
