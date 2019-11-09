{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    <div class="osu-page osu-page--generic">
        @include(i18n_view('users._disabled_message'))
    </div>
@endsection
