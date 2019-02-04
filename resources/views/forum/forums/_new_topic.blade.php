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
@endphp

@if ($newTopicEnabled)
    <a class="btn-osu-big btn-osu-big--forum-button js-login-required--click"
        href="{{ route('forum.topics.create', ['forum_id' => $forum]) }}">
        @if (Auth::check())
            <span class="btn-osu-big__content">
                <span class="btn-osu-big__left">
                    {{ trans('forum.topic.new_topic') }}
                </span>
                <span class="btn-osu-big__icon"><i class="fas fa-plus"></i></span>
            </span>
        @else
            <span class="btn-osu-big__content">
                <span class="btn-osu-big__left">
                    {{ trans('forum.topic.new_topic_login') }}
                </span>
                <span class="btn-osu-big__icon"><i class="fas fa-sign-in-alt"></i></span>
            </span>
        @endif
    </a>
@else
    <span class="btn-osu-big btn-osu-big--forum-button" title="{{ $newTopicAuth->message() }}" disabled>
        <span class="btn-osu-big__content">
            <span class="btn-osu-big__left">
                {{ trans('forum.topic.new_topic') }}
            </span>
            <span class="btn-osu-big__icon"><i class="fas fa-plus"></i></span>
        </span>
    </span>
@endif
