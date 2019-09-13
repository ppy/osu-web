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
        $iconClass = 'fas fa-undo';
        $method = 'post';
    } else {
        $deleteString = 'destroy';
        $iconClass = 'fas fa-trash';
        $method = 'delete';
    }

    if ($type === 'circle') {
        $class = 'btn-circle';
    } else {
        // FIXME: make simple-menu-item block instead
        $class = $class ?? 'simple-menu__item';
    }

    $class .= " js-post-delete-toggle--{$type}";

    $label = trans("forum.post.actions.{$deleteString}");
    $confirmation = trans("forum.post.confirm_{$deleteString}");
    $url = route("forum.posts.{$deleteString}", $post);
@endphp
<button
    type="button"
    class="{{ $class }}"
    data-tooltip-position="top center"
    data-url="{{ $url }}"
    data-remote="true"
    data-method="{{ $method }}"
    data-confirm="{{ $confirmation }}"
    @if ($type === 'circle')
        title="{{ $label }}"
    @endif
>
    @if ($type === 'circle')
        <i class="{{ $iconClass }}"></i>
    @else
        {{ $label }}
    @endif
</button>
