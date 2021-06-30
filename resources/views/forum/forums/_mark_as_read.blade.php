{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $forum = $forum ?? null;
    $recursive = $recursive ?? null;
    $blockClass = $blockClass ?? 'btn-osu-big btn-osu-big--forum-button';
@endphp

<button
    class="{{ $blockClass }}"
    data-disable-with="{{ osu_trans('forum.mark_as_read.busy') }}"
    data-method="POST"
    data-remote="1"
    data-url="{{ route('forum.forums.mark-as-read', ['forum_id' => optional($forum)->getKey(), 'recursive' => $recursive]) }}"
    @if (!auth()->check())
        disabled
    @endif
>
    {{ $forum === null ? osu_trans('forum.mark_as_read.forums') : osu_trans('forum.mark_as_read.forum') }}
</button>
