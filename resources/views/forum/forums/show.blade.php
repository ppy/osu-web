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
    <div class="osu-layout__row-container">
        <div class="osu-layout__row osu-layout__row--page-compact">
            <div class="forum-header forum-category-header forum-category-header--{{ $forum->categorySlug() }} forum-category-header--main">
                <div>
                    <ol class="breadcrumb forums-breadcrumb">
                        @include("forum.forums._nav", ["forum_parents" => $forum->forum_parents])
                    </ol>

                    <h1>
                        <a href="{{ route("forum.forums.show", $forum->forum_id) }}">
                            {{ $forum->forum_name }}
                        </a>
                    </h1>
                </div>
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

            <div class="topics-container">
                <h2>{{ trans("forum.topics") }}</h2>
                @include("forum.forums._topics", ["topics" => $topics, "withNewTopicLink" => $forum->canHavePost()])
            </div>

            @include("forum._pagination", ["object" => $topics])
        </div>
    </div>
@endsection
