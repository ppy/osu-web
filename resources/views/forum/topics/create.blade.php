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
@extends('master', ['legacyFont' => false])

@section('content')
    @include('forum._header', compact('forum'))

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

            <div class="forum-post-content js-post-preview--preview"></div>
        </div>

        @include('forum.topics._post_edit_form', ['type' => 'create', 'content' => $post->post_text])
    {!! Form::close() !!}
@endsection
