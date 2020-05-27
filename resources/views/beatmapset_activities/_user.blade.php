{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    // this is pretty much a php conversion of beatmap-discussions/user-card.coffee
    $topClasses = $bn = 'beatmap-discussion-user-card';
    $group = optional($user)->visibleGroups()[0] ?? null;
    $hideStripe = $hideStripe ?? false;
@endphp

<div class="{{$topClasses}}" style="{!! css_group_colour($group ?? null) !!}">
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
            @if (isset($group))
                <div
                    class="user-group-badge"
                    title="{{ $group->group_name }}"
                    data-label="{{ $group->short_name }}"
                    style="{!! css_group_colour($group) !!}"
                ></div>
            @endif
        </div>
    </div>
    @if (!$hideStripe)
        <div class="{{$bn}}__user-stripe"></div>
    @endif
</div>
