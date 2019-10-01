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
