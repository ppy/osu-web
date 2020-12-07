{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => [
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
                (because Apple has a limit on how many testers can be added)<br/>
                @if (!Auth::user())
                    If you are an osu!supporter, please login for a more permanent link.
                @endif
            </p>
            <center><a href="{{config('osu.urls.testflight.public')}}" rel="nofollow noreferrer">{{config('osu.urls.testflight.public')}}</a></center>
        @endif
    </div>
@endsection
