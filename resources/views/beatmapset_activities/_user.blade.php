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
@php
    // this is pretty much a php conversion of beatmap-discussions/user-card.coffee
    $topClasses = $bn = 'beatmap-discussion-user-card';
    $badge = optional($user)->groupBadge();
    $hideStripe = $hideStripe ?? false;
@endphp

<div class="{{$topClasses}}" style="{!! css_group_colour($badge ?? null) !!}">
    <div class="{{$bn}}__avatar">
        <a class="{{$bn}}__user-link" href="{{route('users.show', $user)}}">
            @if ($user)
                <div class="avatar avatar--full-rounded" style="background-image: url({{$user->user_avatar}})"></div>
            @else
                <div class="avatar avatar--full-rounded avatar--guest"></div>
            @endif
        </a>
    </div>
    <div class="{{$bn}}__user">
        <div class="{{$bn}}__user-row">
            <a class="{{$bn}}__user-link" href="{{route('users.show', $user)}}">
                <span class="{{$bn}}__user-text u-ellipsis-overflow">{{$user->username}}</span>
            </a>
            @if (!$user->is_bot)
                <a class="{{$bn}}__user-modding-history-link" href="{{route('users.modding.index', $user)}}" title="{{trans('beatmap_discussion_posts.item.modding_history_link')}}">
                    <i class='fas fa-align-left'></i>
                </a>
            @endif
        </div>
        <div class="{{$bn}}__user-badge">
            @if (isset($badge))
                <div
                    class="user-group-badge"
                    title="{{ $badge->group_name }}"
                    data-label="{{ $badge->short_name }}"
                    style="{!! css_group_colour($badge) !!}"
                ></div>
            @endif
        </div>
    </div>
    @if (!$hideStripe)
        <div class="{{$bn}}__user-stripe"></div>
    @endif
</div>
