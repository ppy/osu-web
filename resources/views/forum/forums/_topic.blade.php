{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $isRead = $topicReadStatus[$topic->topic_id] ?? false;
@endphp
<li
    class="
        {{ class_with_modifiers('forum-topic-entry', [
            'deleted' => $topic->trashed(),
            'old' => $topic->isOld(),
        ]) }}
        clickable-row
        js-forum-topic-entry
    "
    data-topic-id="{{ $topic->topic_id }}"
>
    <div class="forum-item-stripe"><div class="forum-item-stripe__arrow"></div></div>

    <div class="forum-topic-entry__col forum-topic-entry__col--icon">
        @if (isset($topicReplyStatus[$topic->getKey()]))
            <span class="forum-topic-entry__replied" title="{{ osu_trans('forum.topic.has_replied') }}"></span>
        @endif

        <a
            class="{{ class_with_modifiers('forum-topic-entry__icon', [
                'unread' => !$isRead,
                'small' => $topic->isLocked(),
            ]) }}"
            href="{{ post_url($topic->getKey(), $isRead ? 'latest' : 'unread', false) }}"
            title="{{ osu_trans($isRead ? 'forum.topic.go_to_latest' : 'forum.topic.go_to_unread') }}"
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
                        'user' => forum_user_link(
                            $topic->topic_poster,
                            $topic->topic_first_poster_name,
                            $topic->topic_first_poster_colour,
                            $currentUserId,
                        ),
                    ]) !!}
                </span>
            </div>
        </div>

        <div class="forum-topic-entry__icons">
            @if ($topic->legacyIcon() !== null)
                @include('forum._legacy_icon', ['icon' => $topic->legacyIcon()])
            @endif

            @foreach ($topic->issueTags() as $tag)
                <div
                    title="{{ $tag }}"
                    class="forum-issue-icon forum-issue-icon--{{ str_slug($tag) }}"
                >
                    {!! issue_icon($tag) !!}
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
                    [
                        'user' => forum_user_link(
                            $topic->topic_last_poster_id,
                            $topic->topic_last_poster_name,
                            $topic->topic_last_poster_colour,
                            $currentUserId,
                        ),
                    ]
                ) !!}
            </div>

            <div>
                {!! timeago($topic->topic_last_post_time) !!}
            </div>
        </div>
    </div>

    <a
        class="forum-topic-entry__col forum-topic-entry__col--last-link"
        href="{{ post_url($topic->getKey(), 'latest', false) }}"
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
