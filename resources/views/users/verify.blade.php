{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @include('layout._page_header_v4')

    <div class="osu-page osu-page--generic js-user-verification--on-load">
        {{ osu_trans('users.verify.title') }}
    </div>
@endsection

@section('user-verification-box')
    @include('users._verify_box', compact('email'))
@endsection
