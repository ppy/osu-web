{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
