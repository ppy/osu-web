{{--
    Copyright 2016 ppy Pty. Ltd.

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
    } else {
        $deleteString = 'delete';
        $iconClass = 'fa-trash';
    }
@endphp
<a
    title="{{ trans('forum.post.actions.'.$deleteString) }}"
    data-tooltip-position="left center"
    href="{{ route("forum.posts.$deleteString", $post) }}"
    class="btn-circle js-post-delete-toggle"
    data-remote="true"
    data-method="post"
    data-confirm="{{ trans("forum.post.confirm_".$deleteString) }}"
>
    <i class="fa {{ $iconClass }}"></i>
</a>
