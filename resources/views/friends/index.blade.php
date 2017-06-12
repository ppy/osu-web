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

    <div class="osu-page osu-page--small-desktop osu-page--rankings">
        <div class="user-friends">
            <h2 class="user-home__news-title">Friends</h2>
            <div class="user-friends__list">
                @foreach ($friends as $connection)
                    @php
                        $friend = $connection->target;
                        $online = $friend->isOnline();
                    @endphp
                    <div class="user-card{{$connection->mutual ? ' user-card--mutual' : ''}}" style="background-image: url({{$friend->cover()}});">
                        <div class="user-card__main-card">
                            <img class="user-card__avatar" src="{{$friend->user_avatar}}">
                            <div class="user-card__metadata">
                                <div class="user-card__username">{{$friend->username}}</div>
                                <div class="user-card__flags">
                                    @include('objects._country_flag', [
                                        'country_code' => $friend->country->acronym,
                                    ])
                                    @if ($friend->isSupporter())
                                        <span class="user-card__supporter">
                                            <span class="fa fa-fw fa-heart"></span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="user-card__status user-card__status--{{$online ? 'online' : 'offline'}}">
                            <span class="fa fa-fw fa-circle-o" style="padding-right: 10px;"></span>
                            <span class="user-card__status-message" title="last seen {{$friend->user_lastvisit->diffForHumans()}}">
                                {{$online ? 'Online' : 'Offline'}}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
