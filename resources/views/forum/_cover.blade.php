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
<div class="forum-category-header__actions">
    <div class="forum-post-actions">
        <div>
            <a
                href="#"
                class="js-forum-cover--open-modal
                    forum-post-actions__action
                    forum-category-header__action"
                title="{{ trans('forum.covers.create._') }}"
                data-tooltip-position="left center"
            >
                <i class="fa fa-pencil"></i>
            </a>

            <div class="forum-category-header__cover-uploader js-forum-cover--modal">
                <label
                    class="btn-osu
                        btn-osu--small
                        btn-osu-default
                        js-forum-cover--upload-button
                        fileupload
                        forum-category-header__cover-uploader-label"
                    data-default-file-url="{{ $cover['data']['defaultFileUrl'] or '' }}"
                    data-file-url="{{ $cover['data']['fileUrl'] or '' }}"
                    data-url="{{ $cover['data']['url'] }}"
                    data-custom-method="{{ $cover['data']['method'] }}"
                >
                    {{ trans('forum.covers.create.button') }}
                    <input class="fileupload__input" type="file" />
                </label>

                <p class="forum-category-header__cover-uploader-info">
                    {{ trans('forum.covers.create.info', ['dimensions' => implode('x', $cover['data']['dimensions'])]) }}
                </p>

                <div
                    class="forum-category-header__cover-uploader-overlay js-forum-cover--overlay"
                    data-state="hidden">
                        {{ trans('common.dropzone.target') }}
                </div>
            </div>
        </div>

        <a
            href="#"
            class="js-forum-cover--remove
                forum-post-actions__action
                forum-category-header__action"
            data-destroy-confirm="{{ trans('forum.covers.destroy.confirm') }}"
            title="{{ trans('forum.covers.destroy._') }}"
            data-tooltip-position="left center"
        >
            <i class="fa fa-trash"></i>
        </a>
    </div>
</div>
