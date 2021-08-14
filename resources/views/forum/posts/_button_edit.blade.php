{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    if ($type === 'circle') {
        $class = 'btn-circle';
    }

    $class .= ' js-edit-post-start';
@endphp
<button
    type="button"
    class="{{ $class }}"
    data-tooltip-position="top center"
    data-url="{{ route('forum.posts.edit', $post) }}"
    data-remote="1"
    @if ($type === 'circle')
        title="{{ osu_trans('forum.post.actions.edit') }}"
    @endif
>
    @if ($type === 'circle')
        <span class="btn-circle__content">
            <i class="fas fa-pencil-alt"></i>
        </span>
    @else
        {{ osu_trans('forum.post.actions.edit') }}
    @endif
</button>
