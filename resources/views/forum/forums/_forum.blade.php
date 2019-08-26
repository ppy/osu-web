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
<li class="clickable-row forum-item t-forum-{{ $forum->categorySlug() }}">
    <div class="forum-item-stripe u-forum--before-bg"><span class="fas fa-angle-right"></span></div>

    <div class="forum-item__details">
        {!! link_to(
            route("forum.forums.show", $forum->forum_id),
            $forum->forum_name,
            ["class" => "forum-item__name clickable-row-link"]
        ) !!}
        <div class="forum-item__description">{{ $forum->forum_desc }}</div>

        @if (count($forum->subforums) > 0)
            <ul class="forum-item__subforums">
                @foreach($forum->subforums as $subforum)
                    <li class="forum-item__subforum">
                        <a class="forum-item__link" href="{{ route("forum.forums.show", $subforum->forum_id) }}" title="{{ $subforum->forum_desc }}">
                            <i class="forum-item__subforum-icon fas fa-angle-right"></i>{{ $subforum->forum_name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="forum-item__latest-post">
        @if (($lastTopic = $lastTopics[$forum->getKey()] ?? null) !== null)
            <span class="forum-item__latest-post-label">
                {{ trans('forum.forums.latest_post') }}
            </span>
            <a
                class="forum-item__link u-ellipsis-overflow"
                href="{{ post_url($lastTopic->topic_id, "unread", false) }}"
            >
                @if ($lastTopic->topic_replies > 0)
                    {{ trans('forum.topic.reply_title_prefix') }}:
                @endif
                {{ $lastTopic->topic_title }}
            </a>

            <div>
                {!! trans("forum.topic.latest_post", [
                    "when" => timeago($lastTopic->topic_last_post_time),
                    "user" => link_to_user(
                        $lastTopic->topic_last_poster_id,
                        $lastTopic->topic_last_poster_name,
                        null,
                        ['forum-item__link']
                    ),
                ]) !!}
            </div>
        @endif
    </div>

    <div class="forum-item__arrow">
        <span class="fas fa-angle-right"></span>
    </div>
</li>
