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
@php
    if ($post->trashed()) {
        $deleteString = 'restore';
        $iconClass = 'fa-undo';
        $method = 'post';
    } else {
        $deleteString = 'destroy';
        $iconClass = 'fa-trash';
        $method = 'delete';
    }
@endphp
<button
    type="button"
    class="btn-circle"
    title="{{ trans('forum.post.actions.'.$deleteString) }}"
    data-tooltip-position="left center"
    data-url="{{ route("forum.posts.$deleteString", $post) }}"
    data-remote="true"
    data-method="{{ $method }}"
    data-confirm="{{ trans("forum.post.confirm_".$deleteString) }}"
>
    <span class="btn-circle__content">
        <i class="fas {{ $iconClass }}"></i>
    </span>
</button>
