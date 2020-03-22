{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'theme' => 'password-reset',
    ]])
    <div class="osu-page osu-page--generic-compact">
        @if ($isStarted)
            @include('password_reset._reset')
        @else
            @include('password_reset._initial')
        @endif
    </div>
@endsection
