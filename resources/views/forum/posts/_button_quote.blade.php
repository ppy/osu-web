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
        title="{{ trans('forum.topics.actions.reply_with_quote') }}"
    @endif
>
    @if ($type === 'circle')
        <span class="btn-circle__content">
            <i class="fas fa-comment"></i>
        </span>
    @else
        {{ trans('forum.topics.actions.reply_with_quote') }}
    @endif
</button>
