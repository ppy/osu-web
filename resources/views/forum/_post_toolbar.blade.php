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
<div class="post-box-toolbar">
    <button
        class="btn-circle btn-circle--button btn-circle--bbcode js-bbcode-btn--bold"
        title="{{ trans("bbcode.bold") }}"
        type="button"
    >
        <strong>B</strong>
    </button>

    <button
        class="btn-circle btn-circle--button btn-circle--bbcode js-bbcode-btn--italic"
        title="{{ trans("bbcode.italic") }}"
        type="button"
    >
        <em>I</em>
    </button>

    <button
        class="btn-circle btn-circle--button btn-circle--bbcode js-bbcode-btn--strikethrough"
        title="{{ trans("bbcode.strikethrough") }}"
        type="button"
    >
        <i class="fa fa-strikethrough"></i>
    </button>

    <button
        class="btn-circle btn-circle--button btn-circle--bbcode js-bbcode-btn--heading"
        title="{{ trans("bbcode.heading") }}"
        type="button"
    >
        H
    </button>

    <button
        class="btn-circle btn-circle--button btn-circle--bbcode js-bbcode-btn--link"
        title="{{ trans("bbcode.link") }}"
        type="button"
    >
        <i class="fa fa-link"></i>
    </button>

    <button
        class="btn-circle btn-circle--button btn-circle--bbcode js-bbcode-btn--spoilerbox"
        title="{{ trans("bbcode.spoilerbox") }}"
        type="button"
    >
        <i class="fa fa-barcode"></i>
    </button>

    <button
        class="btn-circle btn-circle--button btn-circle--bbcode js-bbcode-btn--list-numbered"
        title="{{ trans("bbcode.list_numbered") }}"
        type="button"
    >
        <i class="fa fa-list-ol"></i>
    </button>

    <button
        class="btn-circle btn-circle--button btn-circle--bbcode js-bbcode-btn--list"
        title="{{ trans("bbcode.list") }}"
        type="button"
    >
        <i class="fa fa-list"></i>
    </button>

    <button
        class="btn-circle btn-circle--button btn-circle--bbcode js-bbcode-btn--image"
        title="{{ trans("bbcode.image") }}"
        type="button"
    >
        <i class="fa fa-image"></i>
    </button>

    <label class="bbcode-size-select" title="{{ trans("bbcode.size._") }}">
        <span class="bbcode-size-select__label">
            {{ trans("bbcode.size._") }}
        </span>
        <i class="fa fa-chevron-down"></i>

        <select class="bbcode-size-select__select js-bbcode-btn--select">
            <option value="50">{{ trans("bbcode.size.tiny") }}</option>
            <option value="85">{{ trans("bbcode.size.small") }}</option>
            <option value="100" selected>{{ trans("bbcode.size.normal") }}</option>
            <option value="150">{{ trans("bbcode.size.large") }}</option>
        </select>
    </label>
</div>
