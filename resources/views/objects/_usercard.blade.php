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

@if ($user)
    <div class="usercard{{isset($popup) && $popup ? ' usercard--popup' : ''}}" style="background-image: url(/images/layout/beatmaps/default-bg.png);">
        <img class="usercard__background" src="{{$user->cover()}}">
        <div class="usercard__background-overlay"></div>
        <a href="{{route('users.show', ['user' => $user->user_id])}}" class="usercard__link-wrapper">
            <div class="usercard__main-card">
                <div class="usercard__avatar-space">
                    <img class="usercard__avatar" src="{{$user->user_avatar}}">
                </div>
                <div class="usercard__metadata">
                    <div class="usercard__username">{{$user->username}}</div>
                    <div class="usercard__flags">
                        @include('objects._country_flag', [
                            'country_code' => $user->country->acronym,
                            'country_name' => $user->country->name,
                        ])
                        @if ($user->isSupporter())
                            <span class="usercard__supporter">
                                <span class="fa fa-fw fa-heart"></span>
                            </span>
                        @endif
                        <div class="usercard__friend-button">
                            <div class="js-react--friendButton" data-target="{{$user->user_id}}"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="usercard__status-bar usercard__status-bar--{{$user->isOnline() ? 'online' : 'offline'}}">
                <span class="fa fa-fw fa-circle-o usercard__status-icon"></span>
                <span class="usercard__status-message" title="{{$user->isOnline() ? '' : 'last seen ' . $user->user_lastvisit->diffForHumans()}}">
                    {{$user->isOnline() ? trans('users.status.online') : trans('users.status.offline')}}
                </span>
            </div>
        </a>
    </div>
@endif
