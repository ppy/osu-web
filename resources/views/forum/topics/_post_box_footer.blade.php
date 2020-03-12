{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="post-editor-footer">
    <div class="post-editor-footer__col post-editor-footer__col--toolbar">
        @include("forum._post_toolbar")
    </div>

    <div class="post-editor-footer__col post-editor-footer__col--actions">
        @if ($editing ?? false)
            <button
                class="
                    js-ujs-submit-disable
                    js-edit-post-cancel
                    btn-osu-big
                    btn-osu-big--forum-primary
                "
                type="button"
            >
                {{ trans("forum.topic.post_edit.cancel") }}
            </button>
        @endif

        <button
            class="
                btn-osu-big
                btn-osu-big--forum-primary
            "
            type="submit"
            data-disable-with="{{ trans('common.buttons.saving') }}"
        >
            {{ $submitText }}
        </button>
    </div>
</div>
