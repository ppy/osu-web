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
@extends('master', [
    'titlePrepend' => $topic->topic_title,
    'canonicalUrl' => route('forum.topics.show', $topic->topic_id),
    'search' => [
        'params' => [
            'topic_id' => $topic->topic_id,
        ],
        'url' => route('forum.forums.search'),
    ],
    'pageDescription' => $topic->toMetaDescription(),
    'legacyFont' => false,
])

@php
    $headerCover = $cover['fileUrl'] ?? $cover['defaultFileUrl'] ?? null;
    $canEditTitle = priv_check('ForumTopicEdit', $topic)->can();

    $toolbarItems = [];

    if ($canEditTitle) {
        $toolbarItems['edit_title'] = true;
    }

    if (priv_check('ForumTopicCoverEdit', $topic)->can()) {
        $toolbarItems['edit_cover'] = true;
    }
@endphp
@section('content')
    @include('forum.topics._floating_header')
    @include('forum._header', [
        'forum' => $topic->forum,
        'background' => $headerCover,
    ])

    <div class="js-forum__topic-user-can-moderate hidden" data-user-can-moderate="{{ $userCanModerate }}"></div>
    <div class="js-forum__topic-first-post-id hidden" data-first-post-id="{{ $firstPostId }}"></div>

    <div class="js-sticky-header"></div>

    <div class="osu-page osu-page--forum-topic">
        <div class="forum-topic-header-padding js-header--alt js-sync-height--target" data-sync-height-id="sticky-header"></div>

        <div class="js-header--main">
            <div class="forum-topic-title">
                <div class="forum-topic-title__item forum-topic-title__item--main">
                    <div class="forum-topic-title__title-container js-forum-topic-title--toggleable" data-edit="0">
                        <h1 class="forum-topic-title__title forum-topic-title__title--display">
                            {{ $topic->topic_title }}
                        </h1>

                        @if ($canEditTitle)
                            <input
                                class="forum-topic-title__title forum-topic-title__title--edit js-forum-topic-title--input"
                                value="{{ $topic->topic_title }}"
                                name="forum_topic[topic_title]"
                                data-url="{{ route('forum.topics.update', $topic->getKey()) }}"
                                maxlength="{{ App\Models\Forum\Topic::MAX_FIELD_LENGTHS['topic_title'] }}"
                            />
                        @endif
                    </div>
                    <div class="forum-topic-title__post-time">
                        {!! trans("forum.post.posted_at", ["when" => timeago($topic->topic_time)]) !!}
                    </div>
                </div>

                <div class="forum-topic-title__item forum-topic-title__item--counters">
                    <div class="grid-items">
                        @include('forum.topics._header_total_counter', ['newTopic' => false])

                        @if ($userCanModerate)
                            @include('forum.topics._header_deleted_counter', ['newTopic' => false])
                        @endif
                    </div>
                </div>
            </div>

            @if (count($toolbarItems) > 0)
                <div class="forum-topic-toolbar js-forum-topic-title--toggleable">
                    @if (isset($toolbarItems['edit_title']))
                        <div class="forum-topic-toolbar__item forum-topic-toolbar__item--title-edit">
                            <button
                                type="button"
                                class="btn-osu-big btn-osu-big--forum-secondary js-forum-topic-title--cancel"
                            >
                                {{ trans('common.buttons.cancel') }}
                            </button>
                        </div>

                        <div class="forum-topic-toolbar__item forum-topic-toolbar__item--title-edit">
                            <button
                                type="button"
                                class="btn-osu-big btn-osu-big--forum-primary js-forum-topic-title--save"
                            >
                                {{ trans('common.buttons.save') }}
                            </button>
                        </div>

                        <div class="forum-topic-toolbar__item">
                            <button
                                type="button"
                                class="btn-osu-big btn-osu-big--forum-secondary js-forum-topic-title--edit-start"
                            >
                                {{ trans('forum.topics.edit_title.start') }}
                            </button>
                        </div>
                    @endif

                    @if (isset($toolbarItems['edit_cover']))
                        <div class="forum-topic-toolbar__item">
                            @include('forum.topics._cover_editor')
                        </div>
                    @endif
                </div>
            @endif
        </div>

        @if ($topic->poll()->exists())
            <div class="js-header--main">
                @include('forum.topics._poll')
            </div>
        @endif

        @if ($topic->isFeatureTopic())
            <div class="js-header--main">
                @include('forum.topics._feature_vote')
            </div>
        @endif

        @include('objects._show_more_link', [
            'additionalClasses' => 'js-header--alt js-forum-posts-show-more js-forum__posts-show-more--previous',
            'arrow' => 'up',
            'attributes' => ['data-mode' => 'previous'],
            'hidden' => $posts->first()->post_id === $firstPostId,
            'modifiers' => ['forum-topic'],
            'url' => route('forum.topics.show', ['topic' => $topic, 'end' => ($posts->first()->post_id - 1), 'with_deleted' => $showDeleted ? '1' : '0']),
        ])

        @include('forum.topics._posts')

        @include('objects._show_more_link', [
            'additionalClasses' => 'js-forum-posts-show-more js-forum__posts-show-more--next',
            'attributes' => ['data-mode' => 'next'],
            'hidden' => $firstPostPosition + sizeof($posts) - 1 >= $topic->postsCount(),
            'modifiers' => ['forum-topic'],
            'url' => route('forum.topics.show', ['topic' => $topic, 'start' => $posts->last()->post_id + 1, 'with_deleted' => $showDeleted ? '1' : '0']),
        ])
    </div>

    @include('forum.topics._reply')
    <div class="js-sticky-footer" data-sticky-footer-disabled="1" data-sticky-footer-target="forum-topic-reply"></div>
@endsection

@section('permanent-fixed-footer')
    @parent

    <div class="forum-topic-nav">
        <div class="forum-topic-nav__seek-tooltip js-forum-posts-seek--tooltip" data-visibility="hidden">
            <div class="forum-topic-nav__seek-tooltip-number js-forum-posts-seek-tooltip-number">0</div>
        </div>

        <div class="js-forum__posts-seek forum-topic-nav__seek-bar-container">
            <div class="
                forum-topic-nav__seek-bar
                forum-topic-nav__seek-bar--all
                u-forum--bg-link
            "></div>

            <div
                class="
                    js-forum__posts-progress
                    forum-topic-nav__seek-bar
                    u-forum--bg-link
                "
            >
            </div>
        </div>

        <div class="forum-topic-nav__content">
            <div class="forum-topic-nav__group">
                @include('forum.topics._lock', compact('topic'))

                @if ($userCanModerate)
                    @include('forum.topics._moderate_pin', compact('topic'))
                    @include('forum.topics._moderate_move', compact('topic'))

                    @if ($topic->isIssue())
                        @foreach ($topic::ISSUE_TAGS as $type)
                            @include("forum.topics._issue_tag_{$type}")
                        @endforeach
                    @endif

                    @include('forum.topics._moderate_toggle_deleted')
                @endif

                @include('forum.topics._watch', ['topic' => $topic, 'state' => $watch])
            </div>

            <div class="forum-topic-nav__group forum-topic-nav__group--main">
                <a
                    href="{{ route("forum.topics.show", $topic->topic_id) }}"
                    class="js-forum-posts-seek--jump
                        forum-topic-nav__item
                        forum-topic-nav__item--main
                        forum-topic-nav__item--button"
                    data-jump-target="first"
                    data-tooltip-float="fixed"
                    title="{{ trans('forum.topic.jump.first') }}"
                >
                    <span class="forum-topic-nav__item-content">
                        <i class="fas fa-angle-double-left"></i>
                    </span>
                </a>

                <button
                    type="button"
                    class="js-forum-posts-seek--jump
                        forum-topic-nav__item
                        forum-topic-nav__item--main
                        forum-topic-nav__item--button"
                    data-jump-target="previous"
                    data-tooltip-float="fixed"
                    title="{{ trans('forum.topic.jump.previous') }}"
                >
                    <span class="forum-topic-nav__item-content">
                        <i class="fas fa-angle-left"></i>
                    </span>
                </button>

                <div class="
                    post-counter
                    forum-topic-nav__item
                    forum-topic-nav__item--main
                    forum-topic-nav__item--counter
                    js-forum-topic-post-jump--container
                ">
                    <form method="get" class="js-forum-posts-jump-to js-forum-topic-post-jump--form">
                        <input
                            type="text"
                            class="forum-topic-nav__counter
                                forum-topic-nav__counter--left
                                forum-topic-nav__counter--input
                                js-forum-topic-post-jump--input"
                            name="n"
                            autocomplete="off" />
                    </form>

                    <span class="
                        forum-topic-nav__counter
                        forum-topic-nav__counter--left
                        js-forum__posts-counter
                        js-forum-topic-post-jump--counter
                    ">{{ $firstPostPosition }}</span>

                    <span class="forum-topic-nav__counter
                        forum-topic-nav__counter--middle"
                    >/</span>

                    <span
                        class="forum-topic-nav__counter
                            forum-topic-nav__counter--right
                            js-forum__total-count
                        "
                        data-total="{{ $topic->postsCount() }}"
                    >{{ i18n_number_format($topic->postsCount()) }}</span>

                    <div
                        class="js-forum-topic-post-jump--cover forum-topic-nav__counter-cover"
                        data-tooltip-float="fixed"
                        title="{{ trans('forum.topic.jump.enter') }}"
                    ></div>
                </div>

                <button
                    type="button"
                    class="js-forum-posts-seek--jump
                        forum-topic-nav__item
                        forum-topic-nav__item--main
                        forum-topic-nav__item--button"
                    data-jump-target="next"
                    data-tooltip-float="fixed"
                    title="{{ trans('forum.topic.jump.next') }}"
                >
                    <span class="forum-topic-nav__item-content">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </button>

                <a
                    href="{{ route('forum.topics.show', ['topic' => $topic, 'end' => $topic->topic_last_post_id]) }}#forum-post-{{ $topic->topic_last_post_id }}"
                    class="js-forum-posts-seek--jump
                        forum-topic-nav__item
                        forum-topic-nav__item--main
                        forum-topic-nav__item--button"
                    data-jump-target="last"
                    data-tooltip-float="fixed"
                    title="{{ trans('forum.topic.jump.last') }}"
                >
                    <span class="forum-topic-nav__item-content">
                        <i class="fas fa-angle-double-right"></i>
                    </span>
                </a>
            </div>

            <div class="forum-topic-nav__group forum-topic-nav__group--right">
                <a
                    href="{{ route('search', ['mode' => 'forum_post', 'topic_id' => $topic->getKey()]) }}"
                    class="btn-circle btn-circle--topic-nav"
                    data-tooltip-float="fixed"
                    title="{{ trans('forum.topics.actions.search') }}"
                >
                    <span class="btn-circle__content">
                        <i class="fas fa-search"></i>
                    </span>
                </a>

                @if (Auth::check())
                    <button
                        type="button"
                        class="btn-osu-big btn-osu-big--forum-reply js-forum-topic-reply--toggle"
                    >
                        <span class="btn-osu-big__content">
                            <span class="btn-osu-big__left">
                                <span class="btn-osu-big__text-top">
                                    {{ trans('forum.topics.actions.reply') }}
                                </span>
                            </span>

                            <span class="btn-osu-big__toggle">
                                <i class="fas fa-dot-circle"></i>
                            </span>
                        </span>
                    </button>
                @else
                    <button
                        type="button"
                        class="btn-osu-big btn-osu-big--forum-reply js-user-link"
                    >
                        <span class="btn-osu-big__content">
                            <span class="btn-osu-big__icon">
                                <i class="fas fa-sign-in-alt"></i>
                            </span>

                            <span class="btn-osu-big__left">
                                <span class="btn-osu-big__text-top">
                                    {{ trans('forum.topics.actions.login_reply') }}
                                </span>
                            </span>
                        </span>
                    </button>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent

    <script data-turbolinks-eval="always">
        window.postJumpTo = {{ $jumpTo }};
    </script>
@endsection
