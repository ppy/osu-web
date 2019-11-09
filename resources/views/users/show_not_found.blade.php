{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'currentSection' => 'community',
    'currentAction' => 'profile',
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
