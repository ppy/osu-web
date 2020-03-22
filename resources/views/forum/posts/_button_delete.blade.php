{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
