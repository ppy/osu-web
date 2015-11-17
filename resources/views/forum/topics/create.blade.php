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
    {!! Form::open([
        "url" => route("forum.topics.store", $forum),
        "data-preview-url" => route("forum.topics.preview", $forum),
    ]) !!}
        <input type="hidden" name="cover_id" value="{{ Request::old("cover_id") }}" class="js-forum-topic-cover--input">

        <div class="osu-layout__row">
            <div class="forum-category-header forum-category-header--topic forum-category-header--topic-create js-forum-topic-cover--header">
                <div class="forum-category-header__titles">
                    @include('forum.topics._header_breadcrumb', ['headerBreadcrumbExtraClasses' => 'forum-header-breadcrumb--large'])

                    <input
                        class="forum-category-header__title js-forum-placeholder-hide"
                        required
                        tabindex="1"
                        name="title"
                        type="text"
                        value="{{ Request::old("title") }}"
                        placeholder="{{ trans("forum.topic.create.placeholder.title") }}"
                    />
                </div>

                <div class="forum-category-header__actions">
                    <div class="forum-post-actions">
                        <div>
                            <a href="#" class="
                                js-forum-topic-cover--open-modal
                                forum-post-actions__action
                                forum-category-header__action
                            ">
                                <i class="fa fa-pencil"></i>
                            </a>

                            <div class="forum-category-header__cover-uploader js-forum-topic-cover--modal">
                                <label
                                    class="btn-osu btn-osu--small btn-osu-default js-forum-topic-cover--upload-button"
                                    type="button"
                                    data-url="{{ $cover['data']['url'] }}"
                                    data-method="{{ $cover['data']['method'] }}"
                                >
                                    {{ trans('forum.topic_covers.create.button') }}
                                    <input type="file">
                                </label>
                                <p class="forum-category-header__cover-uploader-info">
                                    {{ trans('forum.topic_covers.create.info', ['dimensions' => '2700x700']) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="js-post-preview"></div>

        <div id="topic-post-form" class="osu-layout__row">
            <div class="forum-post forum-post--create {{ Auth::user()->is_special ? 'forum-post--special' : '' }}">
                <div class="forum-post__card">
                    @if (Auth::user()->is_special)
                        <div
                            class="forum-post__stripe"
                            style="{{ user_colour_style(Auth::user()->user_colour, "background-color") }}"
                        ></div>
                    @endif

                    @include("forum.topics._post_info", ["user" => Auth::user(), "options" => ["large" => true]])

                    <div class="forum-post__body">
                        <div class="forum-post__content">
                            @include('forum.posts._form_body', ['postBody' => [
                                'content' => Request::old("body"),
                                'focus' => true,
                                'extraClasses' => 'post-autopreview forum-post-content--edit',
                                'extraAttrs' => 'tabindex="1"',
                            ]])
                        </div>

                        <div class="forum-post__content forum-post__content--edit-bar">
                            @include("forum._post_toolbar")

                            <div class="post-box__actions">
                                <button tabindex="1" class="btn-osu btn-osu--small btn-osu-default post-editor__action" type="submit">
                                    {{ trans("forum.topic.create.submit") }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
