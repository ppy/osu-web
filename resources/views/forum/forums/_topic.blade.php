{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
    <div class="forum-item-stripe u-forum--before-bg"><span class="u-relative fas fa-angle-right"></span></div>

    <div class="forum-topic-entry__col forum-topic-entry__col--icon">
        @if (isset($topicReplyStatus[$topic->getKey()]))
            <span class="forum-topic-entry__replied" title="{{ osu_trans('forum.topic.has_replied') }}"></span>
        @endif

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
                @if ($includeForumName ?? false)
                    <span class="forum-topic-entry__detail">
                        {!! osu_trans('forum.topic.in_forum', [
                            'forum' => link_to(
                                route('forum.forums.show', $topic->forum),
                                $topic->forum->forum_name
                            ),
                        ]) !!}
                    </span>
                @endif

                <span class="forum-topic-entry__detail">
                    {!! osu_trans('forum.topic.started_by', [
                        'user' => tag('span', [
                            'class' => 'forum-topic-entry__user-icon',
                            'style' => user_color_style($topic->topic_first_poster_colour, 'background-color'),
                        ]).' '.link_to_user(
                            $topic->topic_poster,
                            $topic->topic_first_poster_name,
                            null,
                            []
                        )
                    ]) !!}
                </span>
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
                {!! osu_trans_choice(
                    'common.count.post',
                    $topic->topic_replies + 1,
                    ['count_delimited' => tag('strong', ['class' => 'forum-topic-entry__count'], e(i18n_number_format($topic->topic_replies + 1)))]
                ) !!}
            </div>

            <div>
                {!! osu_trans_choice(
                    'common.count.view',
                    $topic->topic_views,
                    ['count_delimited' => tag('strong', ['class' => 'forum-topic-entry__count'], e(i18n_number_format($topic->topic_views)))]
                ) !!}
            </div>

            @if ($topic->isFeatureTopic())
                <div>
                    {!! osu_trans_choice(
                        'common.count.star_priority',
                        $topic->osu_starpriority,
                        ['count_delimited' => tag('strong', ['class' => 'forum-topic-entry__count'], e(i18n_number_format($topic->osu_starpriority)))]
                    ) !!}
                </div>
            @endif
        </div>

        <div class="forum-topic-entry__content forum-topic-entry__content--right">
            <div class="u-ellipsis-overflow">
                {!! osu_trans(
                    $topic->topic_replies === 0 ? 'forum.topic.started_by_verbose' : 'forum.topic.latest_reply_by',
                    ['user' => link_to_user(
                        $topic->topic_last_poster_id,
                        $topic->topic_last_poster_name,
                        null,
                        []
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
        title="{{ osu_trans("forum.topic.go_to_latest") }}"
    >
        <i class="fas fa-chevron-right"></i>
    </a>

    @if (($buttons ?? null) !== null)
        <div class="forum-topic-entry__col forum-topic-entry__col--buttons">
            @include($buttons)
        </div>
    @endif
</li>
