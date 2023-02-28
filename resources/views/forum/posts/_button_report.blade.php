{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    if ($type === 'circle') {
        $class = 'btn-circle';
    }

    $class .= ' js-forum-post-report';
@endphp
<button
    type="button"
    class="{{ $class }}"
    data-tooltip-position="top center"
    @if ($type === 'circle')
        title="{{ osu_trans('forum.post.actions.report') }}"
    @endif
>
    @if ($type === 'circle')
        <span class="btn-circle__content">
            <i class="fas fa-exclamation-triangle"></i>
        </span>
    @else
        {{ osu_trans('forum.post.actions.report') }}
    @endif
</button>
