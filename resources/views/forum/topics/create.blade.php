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
@extends("master")

@section("content")
    <div class="osu-layout__row-container osu-layout__row-container--full">
        {!! Form::open([
            "url" => route("forum.topics.store", $forum),
            "class" => "create-topic post-box",
            "data-preview-url" => route("forum.topics.preview", $forum),
        ]) !!}
            <div class="osu-layout__row osu-layout__row--page-compact">
                <div class="forum-header forum-category-header forum-category-header--main">
                    <div class="topic-header">
                        <ol class="breadcrumb forums-breadcrumb">
                            @include("forum.forums._nav", ["forum_parents" => $forum->forum_parents])
                            <li>
                                <a href="{{ route("forum.forums.show", $forum) }}">
                                    {{ $forum->forum_name }}
                                </a>
                            </li>
                        </ol>
                        <h1>
                            <input required tabindex="1" name="title" type="text" value="{{ Request::old("title") }}" placeholder="{{ trans("forum.topic.create.placeholder.title") }}" />
                        </h1>
                    </div>
                </div>
            </div>

            <div class="content content--forum-topic-preview js-post-preview"></div>

            <div id="topic-post-form" class="forum-post osu-layout__row osu-layout__row--forum-post-create post-editor" data-post-position="1">
                <div class="post-editor__main">
                    <div class="info-panel">
                        @include("forum.topics._post_info", ["user" => Auth::user(), "options" => ["large" => true]])
                    </div>

                    <div class="post-panel">
                        @include('forum.posts._form_body', ['postBody' => [
                            'content' => Request::old("body"),
                            'focus' => true,
                            'extraClasses' => 'post-autopreview',
                            'extraAttrs' => 'tabindex="1"',
                        ]])
                    </div>
                </div>

                <div class="post-footer post-editor__footer post-editor__footer--large">
                    <div class="post-box__toolbar">
                        @include("forum._post_toolbar")
                    </div>

                    <div class="post-box__actions">
                        <button tabindex="1" class="btn-osu btn-osu--small btn-osu-default post-editor__action" type="submit">
                            {{ trans("forum.topic.create.submit") }}
                        </button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
