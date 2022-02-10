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
        bbcode-editor
        bbcode-editor--{{ $type }}
        {{ $type === 'reply' ? 'js-forum-topic-reply--block' : '' }}
        {{ $withPreview ? 'js-bbcode-preview--form' : '' }}
    "
    data-state="write"
>
    @if ($type === 'reply')
        <div class="bbcode-editor__header">
            <h2 class="bbcode-editor__title">
                {{ osu_trans('forum.post.create.title.reply') }}
            </h2>
        </div>
    @endif

    <div class="{{ $type === 'reply' ? 'js-forum-reply-write' : '' }} bbcode-editor__content">
        @if ($type === 'create')
            <input
                class="bbcode-editor__input-title js-form-placeholder-hide"
                placeholder="{{ osu_trans("forum.topic.create.placeholder.title") }}"
                name="title"
            />
        @endif

        <textarea
            class="
                bbcode-editor__body
                js-ujs-submit-disable
                js-bbcode-preview--body
                js-forum-post-input
                {{ $type === 'create' ? 'js-post-preview--auto' : '' }}
                {{ $type === 'reply' ? 'js-forum-topic-reply--input' : '' }}
                {{ in_array($type, ['edit', 'reply'], true) ? 'js-quick-submit' : '' }}
            "
            name="body"
            placeholder="{{ osu_trans('forum.topic.create.placeholder.body') }}"
            data-blur-on-submit-disable="1"
            required
            {{ $type === 'create' ? 'autofocus' : '' }}
            @if (!$enabled)
                disabled
            @endif
            @if (isset($inputId))
                data-forum-post-input-id="{{ $inputId }}"
            @endif
        >{{ $content ?? '' }}</textarea>

        @if ($withPreview)
            <div class="bbcode-editor__preview">
                <div class="
                    forum-post-content
                    js-bbcode-preview--preview
                    {{ $type === 'reply' ? 'forum-post-content--reply-preview' : '' }}
                "></div>
            </div>
        @endif

        <div class="bbcode-editor__buttons-bar">
            <div class="bbcode-editor__buttons bbcode-editor__buttons--toolbar">
                @if ($enabled)
                    @include('forum._post_toolbar')
                @endif
            </div>

            <div class="bbcode-editor__buttons bbcode-editor__buttons--actions">
                @if ($type === 'edit')
                    <div class="bbcode-editor__button bbcode-editor__button--cancel">
                        <button
                            type="button"
                            class="js-ujs-submit-disable js-edit-post-cancel btn-osu-big btn-osu-big--forum-secondary"
                        >
                            {{ osu_trans('forum.topic.post_edit.cancel') }}
                        </button>
                    </div>
                @endif

                @if ($type === 'reply')
                    <div class="bbcode-editor__button bbcode-editor__button--deactivate">
                        <button
                            type="button"
                            class="js-forum-topic-reply--deactivate btn-osu-big btn-osu-big--forum-secondary"
                        >
                            {{ osu_trans('forum.topic.create.close') }}
                        </button>
                    </div>
                @endif

                @if ($withPreview)
                    <div class="bbcode-editor__button bbcode-editor__button--hide-on-write">
                        <button
                            type="button"
                            class="js-bbcode-preview--hide btn-osu-big btn-osu-big--forum-secondary"
                            {{ $enabled ? '' : 'disabled' }}
                        >
                            {{ osu_trans('forum.topic.create.preview_hide') }}
                        </button>
                    </div>

                    <div class="bbcode-editor__button bbcode-editor__button--hide-on-preview">
                        <button
                            type="button"
                            class="js-bbcode-preview--show btn-osu-big btn-osu-big--forum-secondary"
                            {{ $enabled ? '' : 'disabled' }}
                        >
                            {{ osu_trans('forum.topic.create.preview') }}
                        </button>
                    </div>
                @endif

                <div class="bbcode-editor__button">
                    <button
                        class="btn-osu-big btn-osu-big--forum-primary"
                        type="submit"
                        data-disable-with="{{ osu_trans('common.buttons.saving') }}"
                        {{ $enabled ? '' : 'disabled' }}
                    >
                        @if ($type === 'reply')
                            {{ osu_trans('forum.topic.post_reply') }}
                        @elseif ($type === 'edit')
                            {{ osu_trans("forum.topic.post_edit.post") }}
                        @elseif ($type === 'create')
                            {{ osu_trans('forum.topic.create.submit') }}
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
