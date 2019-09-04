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
<div
    class="
        forum-post-edit
        forum-post-edit--{{ $type }}
        js-forum-topic-reply--block
        js-forum-post-preview--form
    "
    data-state="write"
>
    @if ($type === 'reply')
        <div class="forum-post-edit__header">
            <h2 class="forum-post-edit__title">
                {{ trans('forum.post.create.title.reply') }}
            </h2>
        </div>
    @endif

    <div class="js-forum-reply-write forum-post-edit__content">
        <textarea
            class="
                forum-post-edit__body
                js-ujs-submit-disable
                js-forum-post-preview--body
                {{ $type === 'reply' ? 'js-quick-submit js-forum-topic-reply--input' : '' }}
            "
            name="body"
            placeholder="{{ trans('forum.topic.create.placeholder.body') }}"
            required
        >{{ $content ?? '' }}</textarea>

        <div class="forum-post-edit__preview">
            <div class="forum-post-content forum-post-content--reply-preview js-forum-post-preview--preview">
            </div>
        </div>

        <div class="forum-post-edit__buttons-bar">
            <div class="forum-post-edit__buttons forum-post-edit__buttons--toolbar">
                @include("forum._post_toolbar")
            </div>

            <div class="forum-post-edit__buttons forum-post-edit__buttons--actions">
                @if ($type === 'edit')
                    <div class="forum-post-edit__button forum-post-edit__button--cancel">
                        <button
                            type="button"
                            class="js-ujs-submit-disable js-edit-post-cancel btn-osu-big btn-osu-big--forum-secondary"
                        >
                            {{ trans('forum.topic.post_edit.cancel') }}
                        </button>
                    </div>
                @endif

                @if ($type === 'reply')
                    <div class="forum-post-edit__button forum-post-edit__button--deactivate">
                        <button
                            type="button"
                            class="js-forum-topic-reply--deactivate btn-osu-big btn-osu-big--forum-secondary"
                        >
                            {{ trans('forum.topic.create.close') }}
                        </button>
                    </div>
                @endif

                <div class="forum-post-edit__button forum-post-edit__button--write">
                    <button
                        type="button"
                        class="js-forum-post-preview--hide btn-osu-big btn-osu-big--forum-secondary"
                    >
                        {{ trans('forum.topic.create.preview_hide') }}
                    </button>
                </div>

                <div class="forum-post-edit__button forum-post-edit__button--preview">
                    <button
                        type="button"
                        class="js-forum-post-preview--show btn-osu-big btn-osu-big--forum-secondary"
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
                        @if ($type === 'reply')
                            {{ trans('forum.topic.post_reply') }}
                        @elseif ($type === 'edit')
                            {{ trans("forum.topic.post_edit.post") }}
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
