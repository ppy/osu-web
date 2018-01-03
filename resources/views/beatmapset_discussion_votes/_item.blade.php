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
<div class="beatmap-discussion-post beatmapset-activities__discussion-post">
    <div class="beatmapset-activities__vote-user-panel">
        <a href="{{route('users.beatmapset-activities', $vote->user->user_id)}}">
            <div class="beatmap-discussion-post__avatar">
                <div class="avatar avatar--full-rounded" style="background-image: url('{{$vote->user->user_avatar}}');"></div>
            </div>
        </a>
        <span class="beatmap-discussion-post__user-text u-ellipsis-overflow">{!! link_to_user($vote->user) !!}</span>
    </div>

    <div class="beatmapset-activities__vote-icon-spacer">
        @if ($vote->score > 0)
            <i class="fa fa-fw fa-thumbs-up beatmap-discussion-vote--up"></i>
        @else
            <i class="fa fa-fw fa-thumbs-down beatmap-discussion-vote--down"></i>
        @endif
    </div>

    <div class="beatmapset-activities__post-grow">
        @include('beatmap_discussions._item', ['discussion' => $vote->beatmapDiscussion])
    </div>
</div>
