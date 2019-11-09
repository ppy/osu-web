{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{{-- FIXME: THE STYLES --}}
<div class="beatmap-discussion-post__user-container">
    <a class="beatmap-discussion-post__user-link" href="{{ route('users.modding.index', $user) }}">

    </a>
    <div class="beatmap-discussion-post__avatar">
        <div class="avatar avatar--full-rounded" style="background-image: url('{{$user->user_avatar}}');"></div>
    </div>
    <div class="beatmap-discussion-post__user">
        <span class="beatmap-discussion-post__user-text u-ellipsis-overflow">{!! link_to_user($user) !!}</span>
        {!! $slot ?? null !!}
    </div>
</div>
