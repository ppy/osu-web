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
    // assume index page if $forum not set
    $isIndex = !isset($forum);

    if ($isIndex) {
        $links = [
            [
                'title' => trans('forum.forums.index.title'),
                'url' => route('forum.forums.index'),
            ]
        ];
    } else {
        $links = [];
        $links[] = [
            'title' => trans('forum.title'),
            'url' => route('forum.forums.index'),
        ];

        foreach ($forum->forum_parents as $forumId => $forumData) {
            $url = $forumData[1] === 0
                ? route('forum.forums.index').'#forum-'.$forumId
                : route('forum.forums.show', $forumId);
            $title = $forumData[0];

            $links[] = compact('title', 'url');
        }

        $links[] = [
            'title' => $forum->forum_name,
            'url' => route("forum.forums.show", $forum->forum_id),
        ];
    }
@endphp
@include('layout._page_header_v4', ['params' => [
    'backgroundExtraClass' => 'js-forum-cover--header',
    'backgroundImage' => $background ?? null,
    'headerExtraClass' => 'js-header--main',
    'links' => $links,
    'linksBreadcrumb' => true,
    'section' => trans('layout.header.community._'),
    'subSection' => trans('layout.header.community.forum'),
    'theme' => $isIndex ? 'forums-index' : 'forum',
]])
