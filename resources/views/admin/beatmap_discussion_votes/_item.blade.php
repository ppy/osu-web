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
<ul>
    <li>
        <a href="{{ route('beatmapsets.discussion', $vote->beatmapDiscussion->beatmapset) }}#/{{ $vote->beatmapDiscussion->getKey() }}">
            {{ trans('admin.beatmap_discussions.item.permalink') }}
        </a>
    </li>

    <li>
        {!! link_to_user($vote->user) !!}
    </li>

    <li>
        {{ trans('admin.beatmap_discussion_votes.item.score') }}:
        {{ $vote->score }}
    </li>
</ul>
