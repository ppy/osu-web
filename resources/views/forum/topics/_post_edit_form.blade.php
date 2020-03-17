{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $withPreview = in_array($type, ['edit', 'reply'], true);
    $enabled = $enabled ?? true;
@endphp
<div
    class="
        forum-post-edit
        forum-post-edit--{{ $type }}
        {{ $type === 'reply' ? 'js-forum-topic-reply--block' : '' }}
        {{ $withPreview ? 'js-forum-post-preview--form' : '' }}
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

    <div class="{{ $type === 'reply' ? 'js-forum-reply-write' : '' }} forum-post-edit__content">
        @if ($type === 'create')
            <input
                class="forum-post-edit__input-title"
                placeholder="{{ trans("forum.topic.create.placeholder.title") }}"
                name="title"
            />
        @endif

        <textarea
            class="
                forum-post-edit__body
                js-ujs-submit-disable
                js-forum-post-preview--body
                {{ $type === 'create' ? 'js-post-preview--auto' : '' }}
                {{ $type === 'reply' ? 'js-forum-topic-reply--input' : '' }}
                {{ in_array($type, ['edit', 'reply'], true) ? 'js-quick-submit' : '' }}
            "
            name="body"
            placeholder="{{ trans('forum.topic.create.placeholder.body') }}"
            data-blur-on-submit-disable="1"
            required
            {{ $type === 'create' ? 'autofocus' : '' }}
            @if (!$enabled)
                disabled
            @endif
        >{{ $content ?? '' }}</textarea>

        @if ($withPreview)
            <div class="forum-post-edit__preview">
                <div class="
                    forum-post-content
                    js-forum-post-preview--preview
                    {{ $type === 'reply' ? 'forum-post-content--reply-preview' : '' }}
                "></div>
            </div>
        @endif

        <div class="forum-post-edit__buttons-bar">
            <div class="forum-post-edit__buttons forum-post-edit__buttons--toolbar">
                @if ($enabled)
                    @include('forum._post_toolbar')
                @endif
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

                @if ($withPreview)
                    <div class="forum-post-edit__button forum-post-edit__button--write">
                        <button
                            type="button"
                            class="js-forum-post-preview--hide btn-osu-big btn-osu-big--forum-secondary"
                            {{ $enabled ? '' : 'disabled' }}
                        >
                            {{ trans('forum.topic.create.preview_hide') }}
                        </button>
                    </div>

                    <div class="forum-post-edit__button forum-post-edit__button--preview">
                        <button
                            type="button"
                            class="js-forum-post-preview--show btn-osu-big btn-osu-big--forum-secondary"
                            {{ $enabled ? '' : 'disabled' }}
                        >
                            {{ trans('forum.topic.create.preview') }}
                        </button>
                    </div>
                @endif

                <div class="forum-post-edit__button">
                    <button
                        class="btn-osu-big btn-osu-big--forum-primary"
                        type="submit"
                        data-disable-with="{{ trans('common.buttons.saving') }}"
                        {{ $enabled ? '' : 'disabled' }}
                    >
                        @if ($type === 'reply')
                            {{ trans('forum.topic.post_reply') }}
                        @elseif ($type === 'edit')
                            {{ trans("forum.topic.post_edit.post") }}
                        @elseif ($type === 'create')
                            {{ trans('forum.topic.create.submit') }}
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
