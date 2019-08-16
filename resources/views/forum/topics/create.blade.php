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
@extends('master', [
    'bodyAdditionalClasses' => 't-forum-'.$forum->categorySlug(),
    'legacyNav' => false,
    'use2019Font' => true,
])

@section('content')
    @include('forum._header', [
        'forum' => $forum,
        'modifiers' => ['forum'],
    ])

    {!! Form::open([
        'url' => route('forum.topics.store', ['forum_id' => $forum]),
        'data-remote' => true,
        'class' => 'osu-page osu-page--forum-topic',
    ]) !!}
        <input type="hidden" name="cover_id" class="js-forum-cover--input">

        <div class="forum-topic-title">
            <div class="forum-topic-title__item">
                <h1 class="forum-topic-title__title">
                    {{ trans('forum.topic.new_topic') }}
                </h1>
            </div>
        </div>

        <div class="forum-topic-toolbar">
            <div class="forum-topic-toolbar__item">
                <label
                    type="button"
                    class="btn-osu-big btn-osu-big--forum-secondary"
                >
                    <div class="label-toggle">
                        <input
                            class="label-toggle__checkbox js-form-toggle--input"
                            data-form-toggle-id="poll-create"
                            name="with_poll"
                            type="checkbox"
                        />

                        <span class="label-toggle__label label-toggle__label--uncheck">
                            {{ trans('forum.topics.create.create_poll_button.remove') }}
                        </span>

                        <span class="label-toggle__label label-toggle__label--check">
                            {{ trans('forum.topics.create.create_poll_button.add') }}
                        </span>
                    </div>
                </label>
            </div>

            <div class="forum-topic-toolbar__item">
                @include('forum.topics._cover_editor')
            </div>
        </div>

        {{-- inlined style to work with jquery's slide animation --}}
        <div class="forum-poll js-form-toggle--form" data-form-toggle-id="poll-create" style="display: none">
            <div class="forum-poll__row forum-poll__row--title">
                <h2 class="forum-poll__title">
                    {{ trans('forum.topics.create.create_poll') }}
                </h2>
            </div>

            @include('forum.topics._create_poll')
        </div>

        <div class="js-post-preview--box hidden forum-post-preview">
            <div class="forum-post-preview__title">
                {{ trans('forum.topics.create.preview') }}
            </div>

            <div class="forum-post-content js-post-preview--body"></div>
        </div>

        <div class="forum-post-edit forum-post-edit--create">
            <div class="js-forum-reply-write forum-post-edit__content">
                <input
                    class="forum-post-edit__input-title"
                    placeholder="{{ trans("forum.topic.create.placeholder.title") }}"
                    name="title"
                />

                <textarea
                    class="
                        forum-post-edit__body
                        js-ujs-submit-disable
                        js-post-preview--auto
                    "
                    required
                    name="body"
                    placeholder="{{ trans('forum.topic.create.placeholder.body') }}"
                    autofocus
                >{{ $post->post_text }}</textarea>

                <div class="js-forum-reply-preview forum-post-edit__preview">
                    <div class="forum-post-content forum-post-content--reply-preview js-forum-reply-preview--content">
                    </div>
                </div>

                <div class="forum-post-edit__buttons-bar">
                    <div class="forum-post-edit__buttons forum-post-edit__buttons--toolbar">
                        @include("forum._post_toolbar")
                    </div>

                    <div class="forum-post-edit__buttons forum-post-edit__buttons--actions">
                        <div class="forum-post-edit__button forum-post-edit__button--deactivate">
                            <button
                                type="button"
                                class="js-forum-topic-reply--deactivate btn-osu-big btn-osu-big--forum-primary"
                            >
                                {{ trans('forum.topic.create.close') }}
                            </button>
                        </div>

                        <div class="forum-post-edit__button forum-post-edit__button--write">
                            <button
                                type="button"
                                class="js-forum-reply-preview--hide btn-osu-big btn-osu-big--forum-post-edit-preview"
                            >
                                {{ trans('forum.topic.create.preview_hide') }}
                            </button>
                        </div>

                        <div class="forum-post-edit__button forum-post-edit__button--preview">
                            <button
                                type="button"
                                class="js-forum-reply-preview--show btn-osu-big btn-osu-big--forum-post-edit-preview"
                            >
                                {{ trans('forum.topic.create.preview') }}
                            </button>
                        </div>

                        <div class="forum-post-edit__button">
                            <button
                                class="btn-osu-big btn-osu-big--forum-primary"
                                type="submit"
                                data-disable-with="{{ trans('common.buttons.saving') }}"
                            >
                                {{ trans('forum.topic.create.submit') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
