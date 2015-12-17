{{--
    Copyright 2015 ppy Pty. Ltd.

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
<ul class="topics">
    @if ($withNewTopicLink)
        <li class="clickable-row new-topic">
            <div class="read-and-type-icon">
                <a href="{{ route("forum.topics.create", $forum) }}" class="js-login-required--click">
                    <i class="fa fa-plus"></i>
                </a>
            </div>

            <div class="main flex-row">
                <div class="left">
                    <div class="topic-link">
                        <a href="{{ route("forum.topics.create", $forum) }}" class="title clickable-row-link js-login-required--click">
                            {{ trans("forum.topic.new_topic") }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="go-to-last">
                <a href="{{ route("forum.topics.create", $forum) }}" title="{{ trans("forum.topic.new_topic") }}" class="js-login-required--click">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </li>
    @endif

    @foreach($topics as $topic)
        <li class="clickable-row">
            <div class="lock-status-icon {{ $topic->topic_status === 1 ? "locked" : "" }}">
                <div>
                    <i class="fa fa-lock"></i>
                </div>
            </div>

            <div class="
                read-and-type-icon
                {{ $topic->topic_type === 2 ? "announcement" : "normal" }}
                {{ (isset($topicReadStatus[$topic->topic_id]) && $topicReadStatus[$topic->topic_id]) ? "read" : "unread" }}
            ">
                <a href="{{ route("forum.topics.show", $topic->topic_id) }}">
                    <i class="fa {{ $topic->topic_type === 2 ? "fa-exclamation-triangle" : "fa-comment-o" }}"></i>
                </a>
            </div>

            <div class="main flex-row">
                <div class="left">
                    <div class="topic-link">
                    <a href="{{ route("forum.topics.show", $topic->topic_id) }}" class="title clickable-row-link">
                        {{ $topic->titleNormalized() }}
                    </a>

                    <div>
                        {!! trans("forum.topic.started_by", ["user" => link_to_user($topic->topic_poster, $topic->topic_first_poster_name, $topic->topic_first_poster_colour)]) !!}
                    </div>
                    </div>
                </div>

                <div class="forum__issue-icons">
                    @foreach ($topic->issues() as $issue)
                        <div title="{{ $issue }}" class="forum__issue-icon forum__issue-icon--{{ $issue }}">
                            <i class="fa {{ issue_icon($issue) }}"></i>
                        </div>
                    @endforeach
                </div>

                <div class="middle hidden-xs">
                    <div class="views">
                        {{ number_format($topic->topic_views) }}
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="replies">
                        {{ number_format($topic->topic_replies) }}
                        <i class="fa fa-comment-o"></i>
                    </div>
                </div>
                <div class="right">
                    <div class="latest-reply-by">{!! trans("forum.topic.latest_reply_by", ["user" => link_to_user($topic->topic_last_poster_id, $topic->topic_last_poster_name, $topic->topic_last_poster_colour)]) !!}</div>
                    <div class="latest-reply-time">{!! timeago($topic->topic_last_post_time) !!}</div>
                </div>
            </div>

            <div class="go-to-last">
                <a href="{{ post_url($topic->topic_id, "unread", false) }}" title="{{ trans("forum.topic.go_to_latest") }}">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </li>
    @endforeach
</ul>
