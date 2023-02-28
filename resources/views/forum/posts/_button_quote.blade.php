{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    if ($type === 'circle') {
        $class = 'btn-circle';
    }

    $class .= ' js-forum-topic-reply--quote';
@endphp
<button
    type="button"
    class="{{ $class }}"
    data-tooltip-position="top center"
    data-url="{{ route('forum.posts.raw', ['post' => $post, 'quote' => 1]) }}"
    data-remote="1"
    @if ($type === 'circle')
        title="{{ osu_trans('forum.topics.actions.reply_with_quote') }}"
    @endif
>
    @if ($type === 'circle')
        <span class="btn-circle__content">
            <i class="fas fa-comment"></i>
        </span>
    @else
        {{ osu_trans('forum.topics.actions.reply_with_quote') }}
    @endif
</button>
