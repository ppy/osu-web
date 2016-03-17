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
@extends("master", ["body_additional_classes" => "forum-colour " . $forum->categorySlug()])

@section("content")
    <div class="osu-layout__row osu-layout__row--page-compact">
        <div
            class="forum-category-header
                forum-colour__bg--{{ $forum->categorySlug() }}
                forum-category-header--forum
                js-forum-cover--header"
            style="{{ isset($cover['data']['fileUrl']) === true ? "background-image: url('{$cover['data']['fileUrl']}');" : '' }}"
        >
            <div class="forum-category-header__loading js-forum-cover--loading">
                @include('objects._spinner')
            </div>

            <div class="forum-category-header__titles forum-category-header__titles--forum">
                <ol class="breadcrumb forums-breadcrumb">
                    @include("forum.forums._nav", ["forum_parents" => $forum->forum_parents])
                </ol>

                <h1 class="forum-category-header__forum-title">
                    <a class="link--white link--no-underline" href="{{ route("forum.forums.show", $forum->forum_id) }}">
                        {{ $forum->forum_name }}
                    </a>
                </h1>
            </div>

            @if (Auth::check() === true && Auth::user()->isAdmin() === true)
                @include('forum._cover')
            @endif
        </div>
    </div>

    <div class="osu-layout__row osu-layout__row--page">
        @if ($forum->subforums()->exists())
            <h2>{{ trans("forum.subforums") }}</h2>
            @include("forum.forums._forums", ["forums" => $forum->subforums])
        @endif

        @if (count($pinnedTopics) > 0)
            <div class="topics-container">
                <h2>{{ trans("forum.pinned_topics") }}</h2>
                @include("forum.forums._topics", ["topics" => $pinnedTopics, "withNewTopicLink" => false])
            </div>
        @endif

        @if (count($topics) > 0 || $forum->canHavePost() === true)
            <div class="topics-container" id="topics">
                <h2>{{ trans("forum.topics._") }}</h2>
                @include("forum.forums._topics", ["topics" => $topics, "withNewTopicLink" => $forum->canHavePost()])
            </div>

            @include("forum._pagination", ["object" => $topics->fragment('topics')])
        @endif
    </div>
@endsection
