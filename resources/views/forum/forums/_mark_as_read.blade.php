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
    $forum = $forum ?? null;
    $recursive = $recursive ?? null;
    $blockClass = $blockClass ?? 'btn-osu-big btn-osu-big--forum-button';
@endphp

<button
    class="{{ $blockClass }}"
    data-disable-with="{{ trans('forum.mark_as_read.busy') }}"
    data-method="POST"
    data-remote="1"
    data-url="{{ route('forum.forums.mark-as-read', ['forum_id' => optional($forum)->getKey(), 'recursive' => $recursive]) }}"
    @if (!auth()->check())
        disabled
    @endif
>
    {{ $forum === null ? trans('forum.mark_as_read.forums') : trans('forum.mark_as_read.forum') }}
</button>
