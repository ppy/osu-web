{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends("master", [
    "title" => "community / {$topic->topic_title}",
    "body_additional_classes" => "forum-colour " . $topic->forum->categorySlug()
])

@section("content")
    <div class="row-page row-blank" id="topic-header-container">
        <div class="js-forum__sticky-header-marker"></div>

        @foreach(["normal", "sticky"] as $type)
            <div class="forum-header js-forum__header--{{ $type }}">
                <div class="topic-header">
                    <ol class="breadcrumb forums-breadcrumb">
                        @include("forum.forums._nav", ["forum_parents" => $topic->forum->forum_parents])
                        <li>
                            <a href="{{ route("forum.forums.show", $topic->forum->forum_id) }}">
                                {{ $topic->forum->forum_name }}
                            </a>
                        </li>
                    </ol>
                    <h1>
                        <a href="{{ route("forum.topics.show", $topic->topic_id) }}">
                            {{ $topic->topic_title }}
                        </a>
                    </h1>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row-forum-post row-page forum-posts-load-link">
        <a href="{{ route("forum.topics.show", ["topics" => $topic->topic_id, "end" => ($posts->first()->post_id - 1)]) }}" class="js-forum-posts-show-more js-forum__posts-show-more--previous" data-mode="previous">Load more</a>
        <span><i class="fa fa-refresh fa-spin"></i></span>
    </div>

    @include("forum.topics._posts")

    <div class="row-forum-post row-page forum-posts-load-link">
        <a href="{{ post_url($topic->topic_id, $posts->last()->post_id + 1, false) }}" class="js-forum-posts-show-more js-forum__posts-show-more--next" data-mode="next">Load more</a>
        <span><i class="fa fa-refresh fa-spin"></i></span>
    </div>

    @if ($topic->canBeRepliedBy(Auth::user()))
        {!! Form::open(["url" => route("forum.topics.reply", $topic->topic_id), "class" => "row row-blank post-editor post-editor--reply", "id" => "forum-topic-reply-box", "data-remote" => true]) !!}
            <div class="forum-small-row post-editor__main">
                <div class="forum__avatar-container forum__avatar-container--reply hidden-xs">
                    <div
                        class="avatar avatar--full"
                        title="{{ trans("users.show.avatar", ["username" => Auth::user()->username]) }}"
                        style="background-image: url('{{ Auth::user()->user_avatar }}');"
                    ></div>
                </div>

                <textarea required name="body" class="js-quick-submit" placeholder="{{ trans("forum.topic.reply_box_placeholder") }}"></textarea>
            </div>

            <div class="forum-small-row post-editor__footer">
                @include("forum.topics._post_box_footer", ["submitText" => trans("forum.topic.post_reply")])
            </div>
        {!! Form::close() !!}
    @endif

    @include("forum._search", ["topic" => $topic])
@endsection

@section('fixed-bar-rows-bottom')
    @parent

    <div id="forum-topic-navigator" class="js-forum__topic-total-posts" data-total-count="{{ $topic->postsCount() }}">

        @include("objects._radial_progress", ["extraRadialProgressClasses" => "js-forum__posts-progress"])
        <a
            class="jump-link first-post"
            href="{{ route("forum.topics.show", $topic->topic_id) }}"
        >
            <i class="fa fa-angle-double-up"></i>
        </a>

        <div class="post-counter">
            <a href="#" class="current-count js-forum__posts-counter">{{ head($postsPosition) }}</a>
            <div class="total-count">/{{ $topic->postsCount() }}</div>
        </div>

        <a
            class="jump-link last-post"
            href="{{ route("forum.topics.show", ["topics" => $topic->topic_id, "end" => $topic->topic_last_post_id]) }}#forum-post-{{ $topic->topic_last_post_id }}"
        >
            <i class="fa fa-angle-double-down"></i>
        </a>
    </div>
@endsection

@section('script')
    @parent

    <script data-turbolinks-eval="always">
        window.postJumpTo = {{ $jumpTo }};
    </script>
@endsection
