{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
