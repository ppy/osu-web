{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => $topic->topic_title,
    'canonicalUrl' => route('forum.topics.show', $topic->topic_id),
    'pageDescription' => $topic->toMetaDescription(),
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

    <div class="js-react--forum-post-report hidden"></div>
    <div class="js-forum__topic-user-can-moderate hidden" data-user-can-moderate="{{ $userCanModerate }}"></div>
    <div class="js-forum__topic-first-post-id hidden" data-first-post-id="{{ $topic->topic_first_post_id }}"></div>

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
                        <div class="forum-topic-toolbar__item u-relative">
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
            'hidden' => $posts->first()->post_id === $topic->topic_first_post_id,
            'modifiers' => ['forum-topic'],
            'url' => route('forum.topics.show', ['topic' => $topic, 'end' => ($posts->first()->post_id - 1), 'with_deleted' => $showDeleted ? '1' : '0']),
        ])

        @include('forum.topics._posts')

        @include('objects._show_more_link', [
            'additionalClasses' => 'js-forum-posts-show-more js-forum__posts-show-more--next',
            'attributes' => ['data-mode' => 'next'],
            'hidden' => $firstPostPosition + sizeof($posts) - 1 >= $topic->postCount(),
            'modifiers' => ['forum-topic'],
            'url' => route('forum.topics.show', ['topic' => $topic, 'start' => $posts->last()->post_id + 1, 'with_deleted' => $showDeleted ? '1' : '0']),
        ])
    </div>

    @include('forum.topics._reply')
    <div class="js-sticky-footer" data-sticky-footer-disabled="1" data-sticky-footer-target="forum-topic-reply"></div>
@endsection

@section('permanent-fixed-footer')
    @parent

    @include('forum.topics._nav')
@endsection

@section('script')
    @parent

    <script data-turbolinks-eval="always">
        window.postJumpTo = {{ $jumpTo }};
    </script>
@endsection
