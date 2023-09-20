{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    if ($post->topic !== null && $post->topic->topic_first_post_id === $post->getKey()) {
        $object = $post->topic;
        $objectString = 'topic';
        $objectRouteString = 'topics';
    } else {
        $object = $post;
        $objectString= 'post';
        $objectRouteString= 'posts';
    }

    if ($object->trashed()) {
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

    $class .= " js-post-delete-toggle js-post-delete-toggle--{$type}";

    $label = osu_trans("forum.{$objectString}.actions.{$deleteString}");
    $confirmation = osu_trans("forum.{$objectString}.confirm_{$deleteString}");
    $url = route("forum.{$objectRouteString}.{$deleteString}", $object);
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
