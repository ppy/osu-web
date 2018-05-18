{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
<li class="
    forum-topic-entry
    u-forum--hover-area
    {{ $disabled ? 'forum-topic-entry--disabled' : 'clickable-row' }}
">
    <div class="forum-topic-entry__bg"></div>

    @if ($disabled)
        <span class="forum-topic-entry__col forum-topic-entry__col--icon forum-topic-entry__col--icon-plus">
            <i class="fas fa-plus"></i>
        </span>
    @else
        <a
            class="
                forum-topic-entry__col
                forum-topic-entry__col--icon
                forum-topic-entry__col--icon-plus
                js-login-required--click
            "
            href="{{ route('forum.topics.create', ['forum_id' => $forum]) }}"
        >
            @if (Auth::check())
                <i class="fas fa-plus"></i>
            @else
                <i class="fas fa-sign-in-alt"></i>
            @endif
        </a>
    @endif

    <div class="forum-topic-entry__col forum-topic-entry__col--main">
        <div class="forum-topic-entry__content forum-topic-entry__content--left">
            @if ($disabled)
                <span
                    class="
                        u-forum--link
                        u-forum--hover-target
                        forum-topic-entry__title
                    "
                    title="{{ $disabledReason ?? '' }}"
                >{{ trans('forum.topic.new_topic') }}</span>
            @else
                <a
                    class="
                        u-forum--link
                        u-forum--hover-target
                        clickable-row-link
                        js-login-required--click
                        forum-topic-entry__title
                    "
                    href="{{ route('forum.topics.create', ['forum_id' => $forum]) }}"
                >
                    @if (Auth::check())
                        {{ trans('forum.topic.new_topic') }}
                    @else
                        {{ trans('forum.topic.new_topic_login') }}
                    @endif
                </a>
            @endif
        </div>
    </div>

    <a
        class="
            forum-topic-entry__col
            forum-topic-entry__col--last-link
            js-login-required--click
            u-forum--link-hover
        "
        href="{{ route('forum.topics.create', ['forum_id' => $forum]) }}"
        title="{{ trans('forum.topic.new_topic') }}"
    >
        <i class="fas fa-chevron-right"></i>
    </a>
</li>
