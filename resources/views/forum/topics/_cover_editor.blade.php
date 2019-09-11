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
<button
    type="button"
    class="js-click-menu btn-osu-big btn-osu-big--forum-secondary"
    data-click-menu-target="forum-cover-edit"
>
    {{ trans('forum.covers.edit') }}
</button>

<div
    class="js-click-menu js-forum-cover--modal forum-cover-edit"
    data-click-menu-id="forum-cover-edit"
    data-visibility="hidden"
>
    <div class="forum-cover-edit__cover js-forum-cover--header"></div>
    <div class="forum-cover-edit__buttons">
        <label
            class="
                btn-osu-big
                btn-osu-big--forum-cover
                btn-osu-big--forum-cover-edit
                js-forum-cover--upload-button
                fileupload
            "
            data-default-file-url="{{ $cover['defaultFileUrl'] ?? '' }}"
            data-file-url="{{ $cover['fileUrl'] ?? '' }}"
            data-url="{{ $cover['url'] }}"
            data-custom-method="{{ $cover['method'] }}"
        >
            <span class="btn-osu-big__loading-spinner">
                {!! spinner(['center-inline']) !!}
            </span>
            {{ trans('forum.covers.create.button') }}
            <input class="fileupload__input" type="file" />
        </label>

        <button
            type="button"
            class="
                js-forum-cover--remove-button
                btn-osu-big btn-osu-big--forum-cover
                btn-osu-big--forum-cover-edit
            "
            data-destroy-confirm="{{ trans('forum.covers.destroy.confirm') }}"
        >
            <span class="btn-osu-big__loading-spinner">
                {!! spinner(['center-inline']) !!}
            </span>

            {{ trans('forum.covers.destroy._') }}
        </button>
    </div>

    <p class="forum-cover-edit__info">
        {{ trans('forum.covers.create.info', ['dimensions' => implode('x', $cover['dimensions'])]) }}
    </p>

    <div
        class="forum-cover-edit__overlay js-forum-cover--overlay"
        data-state="hidden">
            {{ trans('common.dropzone.target') }}
    </div>
</div>
