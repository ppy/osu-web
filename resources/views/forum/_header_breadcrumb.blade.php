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
<ol class="page-mode page-mode--breadcrumb js-header--main">
    <li class="page-mode__bg u-forum--bg-link"></li>

    <li class="page-mode__item">
        <a href="{{ route('forum.forums.index') }}" class="page-mode-link">
            {{ trans('forum.title') }}

            <span class="page-mode-link__stripe u-forum--bg">
            </span>
        </a>
    </li>

    @foreach ($forum->forum_parents as $forumId => $forumData)
        <li class="page-mode__item">
            <a
                href="{{ $forumData[1] === 0 ?
                    route('forum.forums.index')."#forum-{$forumId}"
                    : route('forum.forums.show', $forumId)
                }}"
                class="page-mode-link"
            >
                {{ $forumData[0] }}

                <span class="page-mode-link__stripe u-forum--bg">
                </span>
            </a>
        </li>
    @endforeach

    <li class="page-mode__item">
        <a
            href="{{ route("forum.forums.show", $forum->forum_id) }}"
            class="page-mode-link page-mode-link--is-active"
        >
            {{ $forum->forum_name }}

            <span class="page-mode-link__stripe u-forum--bg">
            </span>
        </a>
    </li>
</ol>
