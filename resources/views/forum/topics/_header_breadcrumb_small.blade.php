{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<ol class="
    sticky-header-breadcrumbs
">
    <li class="sticky-header-breadcrumbs__item">
        <a href="{{ route('forum.forums.index') }}" class="sticky-header-breadcrumbs__link">
            {{ osu_trans('forum.title') }}
        </a>
    </li>

    @foreach ($forum->forum_parents as $forumId => $forumData)
        <li class="sticky-header-breadcrumbs__item">
            <a
                href="{{ $forumData[1] === 0 ?
                    route('forum.forums.index')."#forum-{$forumId}"
                    : route('forum.forums.show', $forumId)
                }}"
                class="sticky-header-breadcrumbs__link"
            >
                {{ $forumData[0] }}
            </a>
        </li>
    @endforeach

    <li class="sticky-header-breadcrumbs__item">
        <a
            href="{{ route("forum.forums.show", $forum->forum_id) }}"
            class="
                sticky-header-breadcrumbs__link
                sticky-header-breadcrumbs__link--is-active
            "
        >
            {{ $forum->forum_name }}
        </a>
    </li>
</ol>
