{{--
    Copyright 2015 ppy Pty. Ltd.

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
<li><a href="{{ route("forum.forums.index") }}">{{ trans("forum.title") }}</a></li>
@foreach($forum_parents as $forum_id => $forum_data)
    <li>
        @if($forum_data[1] === 0)
            <a href="{{ route("forum.forums.index") }}#forum-{{ $forum_id }}">
                {{ $forum_data[0] }}
            </a>
        @else
            <a href="{{ route("forum.forums.show", $forum_id) }}">
                {{ $forum_data[0] }}
            </a>
        @endif
    </li>
@endforeach
