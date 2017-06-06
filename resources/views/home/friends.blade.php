{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
    @include('home._user_header_default', [
        'title' => trans('home.user.header.welcome', ['username' => Auth::user()->username])
    ])

    <div class="osu-page osu-page--small-desktop">
        <div class="user-home">
            <div class="user-home__news">
                <h2 class="user-home__news-title">Mah Frans</h2>
                @foreach ($friends as $friend)
                    <div class="wang" style="width: 260px; height: 100px; border-radius: 4px; margin: 10px; background: url({{$friend['target']['cover']['url']}}); background-color: #333; background-size: cover ">
                        <img style="width: 50px; height: 50px; margin: 10px; border-radius: 4px;" src="{{$friend['target']['avatar_url']}}">
                        <span style="color: white;">{{$friend['target']['username']}}</span>
                        <div class="thingy" style="height: 30px;width: 100%; background: rgba(179, 228, 17, 0.51); border-bottom-left-radius: 4px; border-bottom-right-radius: 4px; color: white; text-align: center;">online</div> </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
