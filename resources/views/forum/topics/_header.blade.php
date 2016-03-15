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
<?php
    $headerCover = $cover['data']['fileUrl'] ?? $cover['data']['defaultFileUrl'] ?? null;
?>
<div class="osu-layout__row">
    <div
        class="forum-category-header
            forum-category-header--topic
            {{ isset($topic) === true ?
                'forum-category-header--topic-'.$topic->forum->categorySlug()
                : 'forum-category-header--topic-create'
            }}
            js-forum-cover--header
            js-header--main"
        style="{{ $headerCover !== null ? "background-image: url('{$headerCover}');" : '' }}"
    >
        <div class="forum-category-header__loading js-forum-cover--loading">
            @include('objects._spinner')
        </div>

        <div class="forum-category-header__titles">
            @include('forum.topics._header_breadcrumb', ['headerBreadcrumbExtraClasses' => 'forum-header-breadcrumb--large'])

            @if (isset($topic) === true)
                <h1 class="forum-category-header__title">
                    <a href="{{ route("forum.topics.show", $topic->topic_id) }}" class="link--white link--no-underline">
                        {{ $topic->topic_title }}
                    </a>
                </h1>
            @else
                <input
                    class="forum-category-header__title js-forum-placeholder-hide"
                    required
                    tabindex="1"
                    name="title"
                    type="text"
                    value="{{ Request::old("title") }}"
                    placeholder="{{ trans("forum.topic.create.placeholder.title") }}"
                />
            @endif
        </div>

        @if (isset($topic) === false || $topic->canBeEditedBy(Auth::user()))
            @include('forum._cover')
        @endif
    </div>

    @if (isset($topic) === true)
        <div class="forum-topic-header__sticky-marker js-sticky-header" data-sticky-header-target="forum-topic-headernav"></div>
    @endif
</div>
