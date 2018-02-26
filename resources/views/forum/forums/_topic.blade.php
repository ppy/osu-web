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
<li
    class="
        u-forum--hover-area
        forum-topic-entry
        {{ $topic->trashed() ? 'forum-topic-entry--deleted' : '' }}
        clickable-row
        js-forum-topic-entry
    "
    data-topic-id="{{ $topic->topic_id }}"
>
    <div class="forum-topic-entry__bg"></div>

    @if ($topic->isLocked())
        <div class="forum-topic-entry__col forum-topic-entry__col--lock">
            <i class="fa fa-lock"></i>
        </div>
    @endif

    <a
        class="
            forum-topic-entry__col
            forum-topic-entry__col--icon
            {{ ($topicReadStatus[$topic->topic_id] ?? null) ? '' : 'u-forum--bg-link' }}
        "
        href="{{ route("forum.topics.show", $topic->topic_id) }}"
    >
        <i class="
            fa
            fa-{{
                $topic->topic_type === 2 ?
                    'exclamation-triangle' :
                    (($topicReadStatus[$topic->topic_id] ?? null) ? 'comment-o' : 'comment')
            }}
        "></i>
    </a>

    <div class="forum-topic-entry__col forum-topic-entry__col--main">
        <div class="forum-topic-entry__content forum-topic-entry__content--left u-ellipsis-overflow-desktop">
            <a
                href="{{ route("forum.topics.show", $topic->topic_id) }}"
                class="
                    u-forum--link
                    u-forum--hover-target
                    clickable-row-link
                    forum-topic-entry__title
                "
            >
                {{ $topic->titleNormalized() }}
            </a>

            <div>
                {!! trans("forum.topic.started_by", [
                    "user" => link_to_user(
                        $topic->topic_poster,
                        $topic->topic_first_poster_name,
                        $topic->topic_first_poster_colour
                )]) !!}
            </div>
        </div>

        <div class="forum__issue-icons">
            @foreach ($topic->issueTags() as $tag)
                <div
                    title="{{ $tag }}"
                    class="forum__issue-icon forum__issue-icon--{{ $tag }}"
                >
                    <i class="fa {{ issue_icon($tag) }}"></i>
                </div>
            @endforeach
        </div>

        <div class="
            forum-topic-entry__content
            forum-topic-entry__content--middle
            hidden-xs
        ">
            <div
                title="{{ trans('forum.topics.index.views') }}"
                data-tooltip-position="right center"
            >
                {{ number_format($topic->topic_views) }}
                <i class="fa fa-eye"></i>
            </div>

            <div
                title="{{ trans('forum.topics.index.replies') }}"
                data-tooltip-position="right center"
            >
                {{ number_format($topic->topic_replies) }}
                <i class="fa fa-comment-o"></i>
            </div>
        </div>

        <div class="forum-topic-entry__content forum-topic-entry__content--right">
            <div class="u-ellipsis-overflow">
                {!! trans("forum.topic.latest_reply_by", [
                    "user" => link_to_user(
                        $topic->topic_last_poster_id,
                        $topic->topic_last_poster_name,
                        $topic->topic_last_poster_colour
                )]) !!}
            </div>

            <div>
                {!! timeago($topic->topic_last_post_time) !!}
            </div>
        </div>
    </div>

    <a
        class="u-forum--link-hover forum-topic-entry__col forum-topic-entry__col--last-link"
        href="{{ post_url($topic->topic_id, "unread", false) }}"
        title="{{ trans("forum.topic.go_to_latest") }}"
    >
        <i class="fa fa-chevron-right"></i>
    </a>

    @if (($buttons ?? null) !== null)
        <div class="forum-topic-entry__col forum-topic-entry__col--buttons">
            @include($buttons)
        </div>
    @endif
</li>
