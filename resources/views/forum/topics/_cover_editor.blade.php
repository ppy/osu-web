{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
