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
        <a href="{{ route('beatmapsets.discussion', $discussion->beatmapset) }}#/{{ $discussion->getKey() }}">
            {{ trans('admin.beatmap_discussions.item.permalink') }}
        </a>
    </li>

    <li>
        {!! link_to_user($discussion->user) !!}
    </li>

    <li>
        {{ trans('admin.beatmap_discussions.item.message_type') }}: {{ $discussion->message_type ?? 'invalid' }}
    </li>

    <li>
        {{ trans('admin.beatmap_discussions.item.created_at') }}: {{ $discussion->created_at }}
    </li>

    @if ($discussion->deleted_at !== null)
        <li>
            {{ trans('admin.beatmap_discussions.item.deleted_at') }}: {{ $discussion->deleted_at }}
        </li>
    @endif

    <li>
        {{ trans('admin.beatmap_discussion_posts.item.content') }}:
        <pre>{{ $discussion->startingPost->message }}</pre>
    </li>
</ul>
