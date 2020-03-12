{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="beatmap-discussion-post beatmapset-activities__discussion-post">
    <div class="beatmapset-activities__vote-user-panel">
        <a href="{{route('users.modding.index', $vote->user->user_id)}}">
            <div class="beatmap-discussion-post__avatar">
                <div class="avatar avatar--full-rounded" style="background-image: url('{{$vote->user->user_avatar}}');"></div>
            </div>
        </a>
        <span class="beatmap-discussion-post__user-text u-ellipsis-overflow">{!! link_to_user($vote->user) !!}</span>
    </div>

    <div class="beatmapset-activities__vote-icon-spacer">
        @if ($vote->score > 0)
            <i class="fas fa-fw fa-thumbs-up beatmap-discussion-vote--up"></i>
        @else
            <i class="fas fa-fw fa-thumbs-down beatmap-discussion-vote--down"></i>
        @endif
    </div>

    <div class="beatmapset-activities__post-grow">
        @include('beatmap_discussions._item', ['discussion' => $vote->beatmapDiscussion])
    </div>
</div>
