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
<ul class="forums">
    @foreach($forums as $forum)
        <li class="forums__forum clickable-row u-forum--hover-area">
            @if ($forum->forum_type === 1)
                <div class="forums__hover-bar hidden-xs">
                    <div class="forums__colour-stripe u-forum--bg"></div>
                    <div class="forums__hover-bar-icon">
                        <i class="fa fa-angle-right"></i>
                    </div>
                </div>
                <div class="left">
                    {!! link_to(route("forum.forums.show", $forum->forum_id), $forum->forum_name, ["class" => "name clickable-row-link u-forum--hover-target u-forum--link"]) !!}
                    <div class="description">{{ $forum->forum_desc }}</div>
                    <ul class="subforums">
                        @foreach($forum->subforums as $subforum)
                            <li>
                                <a class="name u-forum--link" href="{{ route("forum.forums.show", $subforum->forum_id) }}" title="{{ $subforum->forum_desc }}">
                                    <i class="fa fa-bars"></i>{{ $subforum->forum_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="right hidden-xs">
                    <div class="right-content">
                        @if ($forum->lastTopic())
                            <a
                                class="forums__forum-topic-link u-forum--link u-ellipsis-overflow"
                                href="{{ post_url($forum->lastTopic()->topic_id, "unread", false) }}"
                            >
                                {{ $forum->lastTopic()->topic_title }}
                            </a>

                            <div>
                                {!! trans("forum.topic.latest_post", [
                                    "when" => timeago($forum->lastTopic()->topic_last_post_time),
                                    "user" => link_to_user($forum->lastTopic()->topic_last_poster_id, $forum->lastTopic()->topic_last_poster_name, $forum->lastTopic()->topic_last_poster_colour)
                                ]) !!}
                            </div>
                        @endif
                    </div>
                </div>
            @elseif ($forum->forum_type === 2)
                <div class="forums__hover-bar hidden-xs">
                    <div class="forums__colour-stripe u-forum--bg"></div>
                    <div class="forums__hover-bar-icon">
                        <i class="fa fa-link"></i>
                    </div>
                </div>
                <div class="left">
                    {!! link_to($forum->forum_link, $forum->forum_name, ["class" => "name clickable-row-link"]) !!}
                    <div class="description">{{ $forum->forum_desc }}</div>
                </div>
            @endif
        </li>
    @endforeach
</ul>
