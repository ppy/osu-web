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
    $isRead = $topicReadStatus[$topic->topic_id] ?? false;
@endphp
<li
    class="
        forum-topic-entry
        {{ $topic->trashed() ? 'forum-topic-entry--deleted' : '' }}
        clickable-row
        js-forum-topic-entry
        t-forum-{{ $topic->forum->categorySlug() }}
    "
    data-topic-id="{{ $topic->topic_id }}"
>
    <div class="forum-item-stripe u-forum--before-bg"><span class="fas fa-angle-right"></span></div>

    <div class="forum-topic-entry__col forum-topic-entry__col--icon">
        <a
            class="
                forum-topic-entry__icon
                {{ $isRead ? '' : 'forum-topic-entry__icon--unread' }}
                {{ $topic->isLocked() ? 'forum-topic-entry__icon--small' : '' }}
            "
            href="{{ route("forum.topics.show", $topic->topic_id) }}"
        >
            <span>
                <i class="
                    {{
                        $topic->topic_type === 2 ?
                            'fas fa-exclamation-triangle' :
                            ($isRead ? 'far fa-comment-alt' : 'fas fa-comment-alt')
                    }}
                "></i>

                @if ($topic->isLocked())
                    <i class="fas fa-lock"></i>
                @endif
            </span>
        </a>
    </div>

    <div class="forum-topic-entry__col forum-topic-entry__col--main">
        <div class="forum-topic-entry__content forum-topic-entry__content--left">
            <a
                href="{{ route("forum.topics.show", $topic->topic_id) }}"
                class="
                    u-ellipsis-overflow-desktop
                    clickable-row-link
                    forum-topic-entry__title
                "
            >
                {{ $topic->titleNormalized() }}
            </a>

            <div>
                {!! trans('forum.topic.started_by', [
                    'user' => tag('span', [
                        'class' => 'forum-topic-entry__user-icon',
                        'style' => user_color_style($topic->topic_first_poster_colour, 'background-color'),
                    ]).' '.link_to_user(
                        $topic->topic_poster,
                        $topic->topic_first_poster_name,
                        null,
                        ['forum-topic-entry__link']
                    )
                ]) !!}
            </div>
        </div>

        <div class="forum-topic-entry__issue-icons">
            @foreach ($topic->issueTags() as $tag)
                <div
                    title="{{ $tag }}"
                    class="forum-issue-icon forum-issue-icon--{{ $tag }}"
                >
                    <i class="{{ issue_icon($tag) }}"></i>
                </div>
            @endforeach
        </div>

        <div class="
            forum-topic-entry__content
            forum-topic-entry__content--counts
            hidden-xs
        ">
            <div>
                {!! trans_choice(
                    'common.count.post',
                    $topic->topic_replies + 1,
                    ['count_delimited' => tag('strong', ['class' => 'forum-topic-entry__count'], e(i18n_number_format($topic->topic_replies + 1)))]
                ) !!}
            </div>

            <div>
                {!! trans_choice(
                    'common.count.view',
                    $topic->topic_views,
                    ['count_delimited' => tag('strong', ['class' => 'forum-topic-entry__count'], e(i18n_number_format($topic->topic_views)))]
                ) !!}
            </div>

            @if ($topic->isFeatureTopic())
                <div>
                    {!! trans_choice(
                        'common.count.star_priority',
                        $topic->osu_starpriority,
                        ['count_delimited' => tag('strong', ['class' => 'forum-topic-entry__count'], e(i18n_number_format($topic->osu_starpriority)))]
                    ) !!}
                </div>
            @endif
        </div>

        <div class="forum-topic-entry__content forum-topic-entry__content--right">
            <div class="u-ellipsis-overflow">
                {!! trans(
                    $topic->topic_replies === 0 ? 'forum.topic.started_by_verbose' : 'forum.topic.latest_reply_by',
                    ['user' => link_to_user(
                        $topic->topic_last_poster_id,
                        $topic->topic_last_poster_name,
                        null,
                        ['forum-topic-entry__link']
                    )]
                ) !!}
            </div>

            <div>
                {!! timeago($topic->topic_last_post_time) !!}
            </div>
        </div>
    </div>

    <a
        class="forum-topic-entry__col forum-topic-entry__col--last-link"
        href="{{ post_url($topic->topic_id, "unread", false) }}"
        title="{{ trans("forum.topic.go_to_latest") }}"
    >
        <i class="fas fa-chevron-right"></i>
    </a>

    @if (($buttons ?? null) !== null)
        <div class="forum-topic-entry__col forum-topic-entry__col--buttons">
            @include($buttons)
        </div>
    @endif
</li>
