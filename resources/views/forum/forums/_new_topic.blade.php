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
    $newTopicAuth = priv_check('ForumTopicStore', $forum);
    $newTopicEnabled = $newTopicAuth->can() || $newTopicAuth->requireLogin();
    $blockClass = $blockClass ?? 'btn-osu-big btn-osu-big--forum-button';

    if ($newTopicEnabled) {
        $element = 'a';
        $blockClass .= ' js-login-required--click';
        $attributes = [
            'href' => route('forum.topics.create', ['forum_id' => $forum]),
        ];
        if (!auth()->check()) {
            $icon = 'fas fa-sign-in-alt';
            $text = trans('forum.topic.new_topic_login');
        }
    } else {
        $element = 'span';
        $attributes = [
            'disabled' => 1,
            'title' => $newTopicAuth->message(),
        ];
    }
@endphp
<{!! $element !!}
    class="{{ $blockClass }}"
    @foreach ($attributes as $key => $value)
        {{ $key }}="{{ $value }}"
    @endforeach
>
    @if ($withIcon ?? true)
        <i class="{{ $icon ?? 'fas fa-plus' }}"></i>
    @endif
    {{ $text ?? trans('forum.topic.new_topic') }}
</{!! $element !!}>
