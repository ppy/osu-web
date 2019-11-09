{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

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
