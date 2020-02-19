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
@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'section' => trans('layout.header.home._'),
        'subSection' => 'testflight',
        'theme' => 'home',
    ]])
    <div class="osu-page osu-page--generic">
        @if (Auth::user() && Auth::user()->isSupporter())
            <p>
                This is a private link for osu!supporters. <strong>Please do not share it.</strong><br />
                If you want to share access to the iOS beta with other users, link them to <a href="{{route('testflight')}}">this page</a> instead.
            </p>
            <center><a href="{{config('osu.urls.testflight.supporter')}}" rel="nofollow noreferrer">{{config('osu.urls.testflight.supporter')}}</a></center>
        @else
            <p>
                Note that we may reset this link every few months to allow new users to test.<br/>
                (because Apple have a limit on how many testers can be added)<br/>
                @if (!Auth::user())
                    If you are an osu!supporter, please login for a more permanent link.
                @endif
            </p>
            <center><a href="{{config('osu.urls.testflight.public')}}" rel="nofollow noreferrer">{{config('osu.urls.testflight.public')}}</a></center>
        @endif
    </div>
@endsection
