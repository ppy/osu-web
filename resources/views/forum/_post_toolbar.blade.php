{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
<div class="post-box-toolbar">
    <span class="bbcode-btn bbcode-btn--bold" title="{{ trans("bbcode.bold") }}">
        B
    </span>

    <span class="bbcode-btn bbcode-btn--italic" title="{{ trans("bbcode.italic") }}">
        I
    </span>

    <span class="bbcode-btn bbcode-btn--strikethrough" title="{{ trans("bbcode.strikethrough") }}">
        <i class="fa fa-strikethrough"></i>
    </span>

    <span class="bbcode-btn bbcode-btn--heading" title="{{ trans("bbcode.heading") }}">
        H
    </span>

    <span class="bbcode-btn bbcode-btn--link" title="{{ trans("bbcode.link") }}">
        <i class="fa fa-link"></i>
    </span>

    <span class="bbcode-btn bbcode-btn--spoilerbox" title="{{ trans("bbcode.spoilerbox") }}">
        <i class="fa fa-barcode"></i>
    </span>

    <span class="bbcode-btn bbcode-btn--list-numbered" title="{{ trans("bbcode.list_numbered") }}">
        <i class="fa fa-list-ol"></i>
    </span>

    <span class="bbcode-btn bbcode-btn--list" title="{{ trans("bbcode.list") }}">
        <i class="fa fa-list"></i>
    </span>

    <span class="bbcode-btn bbcode-btn--image" title="{{ trans("bbcode.image") }}">
        <i class="fa fa-image"></i>
    </span>

    <label class="bbcode-size-group bbcode-item--extra-space" title="{{ trans("bbcode.size._") }}">
        <span>
            {{ trans("bbcode.size._") }}
        </span>
        <i class="fa fa-chevron-down"></i>

        <select class="bbcode-size">
            <option value="50">{{ trans("bbcode.size.tiny") }}</option>
            <option value="85">{{ trans("bbcode.size.small") }}</option>
            <option value="100" selected>{{ trans("bbcode.size.normal") }}</option>
            <option value="150">{{ trans("bbcode.size.large") }}</option>
        </select>
    </label>
</div>
