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
    if (isset($forum)) {
        $tree = [];

        $tree[route('forum.forums.index')] = trans('forum.title');

        foreach ($forum->forum_parents as $forumId => $forumData) {
            $url = $forumData[1] === 0
                ? route('forum.forums.index').'#forum-'.$forumId
                : route('forum.forums.show', $forumId);
            $title = $forumData[0];

            $tree[$url] = $title;

        }
        $tree[route("forum.forums.show", $forum->forum_id)] = $forum->forum_name;
    } else {
        // assume on index page
        $tree = [
            route('forum.forums.index') => trans('forum.forums.index.title'),
        ];
    }
@endphp
<ol class="header-nav-v4 js-header--main">
    @foreach ($tree as $url => $name)
        <li class="header-nav-v4__item">
            <a href="{{ $url }}" class="header-nav-v4__link">
                {{ $name }}
            </a>
        </li>
    @endforeach
</ol>
