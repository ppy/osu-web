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
@php
    $blockClass = 'usercard';
    if (isset($popup) && $popup) {
        $blockClass .= ' usercard--popup';
    }
    if (count($_modifiers ?? []) > 0) {
        foreach ($_modifiers as $modifier) {
            $blockClass .= ' usercard--'.$modifier;
        }
    }
@endphp
@if (isset($user) || isset($loading))
    <div class="{{ $blockClass }}">
        @if (isset($loading))
            <div class="usercard__background-overlay usercard__background-overlay--guest"></div>
        @else
            <a href="{{route('users.show', ['user' => $user->user_id])}}" class="usercard__background-container">
                @if ($user->cover() === null)
                    <div class="usercard__background-overlay usercard__background-overlay--guest"></div>
                @else
                    <img class="usercard__background" src="{{$user->cover()}}">
                    <div class="usercard__background-overlay"></div>
                @endif
            </a>
        @endif
        <div class="usercard__card">
            <div class="usercard__card-content">
                <div class="usercard__avatar-space">
                    <div class="usercard__avatar usercard__avatar--loader js-usercard--avatar-loader">
                        <i class="fa fa-fw fa-refresh fa-spin"></i>
                    </div>
                    @if (!isset($loading))
                        <img class="usercard__avatar usercard__avatar--main" src="{{$user->user_avatar}}">
                    @endif
                </div>
                <div class="usercard__metadata">
                    <div class="usercard__username">{{ isset($loading) ? trans('users.card.loading') : $user->username }}</div>
                    <div class="usercard__icons">
                        @if (isset($loading))
                            <div class="usercard__icon">
                                @include('objects._country_flag', ['country_code' => 'XX'])
                            </div>
                        @else
                            @if (isset($user->country))
                                <div class="usercard__icon">
                                    <a href="{{route('rankings', ['mode' => 'osu', 'type' => 'performance', 'country' => $user->country->acronym])}}">
                                        @include('objects._country_flag', [
                                            'country_code' => $user->country->acronym,
                                            'country_name' => $user->country->name,
                                        ])
                                    </a>
                                </div>
                            @endif
                            @if ($user->isSupporter())
                                <div class="usercard__icon">
                                    <a class="usercard__link-wrapper" href="{{route('support-the-game')}}">
                                        <span class="usercard__supporter" title="{{ trans('users.show.is_supporter') }}">
                                            <span class="fa fa-fw fa-heart"></span>
                                        </span>
                                    </a>
                                </div>
                            @endif
                            <div class="usercard__icon js-react--friendButton" data-target="{{$user->user_id}}"></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="usercard__status-bar usercard__status-bar--{{!isset($loading) && $user->isOnline() ? 'online' : 'offline'}}">
                <span class="fa fa-fw fa-circle-o usercard__status-icon"></span>
                <span class="usercard__status-message" title="{{isset($loading) || $user->isOnline() ? '' : ($user->user_lastvisit ? trans('users.show.lastvisit', ['date' => $user->user_lastvisit->diffForHumans()]) : '')}}">
                    {{!isset($loading) && $user->isOnline() ? trans('users.status.online') : trans('users.status.offline')}}
                </span>
            </div>
        </div>
    </div>
@endif
