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
@extends('master', [
    'titlePrepend' => $topic->topic_title,
    "body_additional_classes" => 't-forum-'.$topic->forum->categorySlug(),
    'canonicalUrl' => route('forum.topics.show', $topic->topic_id),
    'search' => [
        'params' => [
            'topic_id' => $topic->topic_id,
        ],
        'url' => route('forum.forums.search'),
    ],
    'pageDescription' => $topic->toMetaDescription(),
])

@section("content")
    <div class="js-forum__topic-first-post-id hidden" data-first-post-id="{{ $firstPostId }}"></div>
    <div class="forum-topic-headernav js-forum-topic-headernav js-sync-height--reference" data-sync-height-target="forum-topic-headernav" data-visibility="hidden">
        <div class="forum-topic-headernav__stripe
            u-forum--bg-link
        "></div>

        <div class="osu-page"><div class="forum-topic-headernav__content">
            <div class="forum-topic-headernav__logo">
                @include('objects.logo-menu', ['logoMenuHoverBgClass' => 'u-forum--bg-link'])
            </div>

            <div class="forum-topic-headernav__titles">
                <div class="forum-topic-headernav__title">
                    @include('forum.topics._header_breadcrumb_small', [
                        'forum' => $topic->forum,
                    ])
                </div>

                <h1 class="forum-topic-headernav__title">
                    <a href="{{ route("forum.topics.show", $topic->topic_id) }}" class="link--white">
                        {{ $topic->topic_title }}
                    </a>
                </h1>
            </div>
        </div></div>
    </div>

    @include('forum.topics._header')

    <div class="js-header--alt js-sync-height--target" data-sync-height-id="forum-topic-headernav"></div>

    @if ($topic->poll()->exists())
        <div class="osu-layout__row js-header--main">
            @include('forum.topics._poll')
        </div>
    @endif

    @if (false && $topic->isFeatureTopic())
        <div class="forum-topic-feature-vote">
            <p>
                @foreach ($topic->featureVotes as $vote)
                    <span>+{{ $vote->voteIncrement() }} by {{ $vote->user->username }}</span>
                @endforeach
            </p>
            <p>
                {{ trans('forum.topics.show.feature_vote.current', [
                    'count' => $topic->osu_starpriority,
                ]) }}
            </p>

            @if (Auth::check())
                @if (Auth::user()->osu_featurevotes >= App\Models\Forum\FeatureVote::COST)
                    <a href="{{ route('forum.topics.vote-feature', $topic->getKey()) }}" data-method="POST" data-remote=1>
                        {{ trans('forum.topics.show.feature_vote.do') }}
                    </a>
                @else
                    <p>
                        {{ trans('forum.topics.show.feature_vote.user.not_enough') }}
                    </p>
                @endif

                <p>
                    {{ trans('forum.topics.show.feature_vote.user.current', [
                        'votes' => trans_choice('forum.topics.show.feature_vote.user.count', Auth::user()->osu_featurevotes),
                    ]) }}
                </p>
            @endif
        </div>
    @endif

    <div class="forum-posts-load-link js-header--alt {{ $posts->first()->post_id === $firstPostId ? 'hidden' : '' }}">
        <a href="{{ route("forum.topics.show", ["topics" => $topic->topic_id, "end" => ($posts->first()->post_id - 1)]) }}" class="js-forum-posts-show-more js-forum__posts-show-more--previous" data-mode="previous">Load more</a>
        <span><i class="fa fa-refresh fa-spin"></i></span>
    </div>

    @include("forum.topics._posts")

    <div class="forum-posts-load-link {{ $firstPostPosition + sizeof($posts) - 1 >= $topic->postsCount() ? 'hidden' : '' }}">
        <a href="{{ post_url($topic->topic_id, $posts->last()->post_id + 1, false) }}" class="js-forum-posts-show-more js-forum__posts-show-more--next" data-mode="next">Load more</a>
        <span><i class="fa fa-refresh fa-spin"></i></span>
    </div>

    @if (priv_check('ForumTopicReply', $topic)->can())
        <div class="js-forum-topic-reply--container js-sync-height--target forum-topic-reply" data-sync-height-id="forum-topic-reply">
            {!! Form::open([
                "url" => route("forum.topics.reply", $topic->topic_id),
                "class" => "forum-post forum-post--reply js-forum-topic-reply js-sync-height--reference js-fixed-element",
                "data-remote" => true,
                "data-sync-height-target" => "forum-topic-reply",
                'data-force-reload' => Auth::check() === false ? '1' : '0',
            ]) !!}
                <div class="forum-post__reply-container">
                    <div class="osu-layout__row osu-layout__row--sm2-desktop osu-layout__row--full-height">
                        <div class="forum-post__reply-content">
                            <div class="forum-post__info-panel forum-post__info-panel--reply hidden-xs">
                                @if (Auth::check() === true)
                                    <div
                                        class="avatar avatar--forum-reply"
                                        style="background-image: url('{{ Auth::user()->user_avatar }}');"
                                    ></div>
                                @else
                                    <div class="avatar avatar--forum-reply avatar--guest"></div>
                                @endif
                            </div>

                            <div class="forum-post__reply-body">
                                <div class="forum-post__content forum-post__content--reply-tabs">
                                    <ul class="page-mode page-mode--post-reply">
                                        <li class="page-mode__item">
                                            <a href="#" class="js-forum-reply-preview--hide page-mode-link page-mode-link--post-reply js-is-active">
                                                {{ trans('forum.topic.create.preview_hide') }}
                                                <span class="page-mode-link__stripe"></span>
                                            </a>
                                        </li>
                                        <li class="page-mode__item">
                                            <a href="#" class="js-forum-reply-preview--show page-mode-link page-mode-link--post-reply">
                                                {{ trans('forum.topic.create.preview') }}
                                                <span class="page-mode-link__stripe"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="js-forum-reply-write forum-post__body forum-post__body--reply-form">
                                    <div class="forum-post__content forum-post__content--edit-body">
                                        @include('forum.posts._form_body', ['postBody' => [
                                            'focus' => false,
                                            'extraClasses' => 'forum-post-content--reply js-forum-topic-reply--input',
                                        ]])
                                    </div>

                                    <div class="forum-post__content forum-post__content forum-post__content--edit-bar hidden">
                                    </div>

                                    <div class="forum-post__content forum-post__content forum-post__content--edit-bar">
                                        @include("forum.topics._post_box_footer", ["submitText" => trans("forum.topic.post_reply")])
                                    </div>
                                </div>
                                <div class="js-forum-reply-preview hidden forum-post__body">
                                    <div class="forum-post__content forum-post__content--main">
                                        <div class="forum-post-content forum-post-content--reply-preview js-forum-reply-preview--content">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>

        <div class="js-sticky-footer" data-sticky-footer-disabled="1" data-sticky-footer-target="forum-topic-reply"></div>
    @else
        <div class="osu-layout__row osu-layout__row--sm2-desktop">
            <div class="warning-box">
                <div class="warning-box__icon">
                    <i class="fa fa-warning"></i>
                </div>

                {{ priv_check('ForumTopicReply', $topic)->message() }}
            </div>
        </div>
    @endif
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
                @if (priv_check('ForumTopicModerate', $topic)->can())
                    @include('forum.topics._moderate_pin', compact('topic'))
                @endif

                @if (priv_check('ForumTopicModerate', $topic)->can())
                    @include('forum.topics._moderate_move', compact('topic'))
                @endif

                @if ($topic->isIssue() && priv_check('ForumTopicModerate', $topic)->can())
                    @foreach ($topic::ISSUE_TAGS as $type)
                        @include("forum.topics._issue_tag_{$type}")
                    @endforeach
                @endif

                @include('forum.topics._watch', ['topic' => $topic, 'state' => $isWatching])
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
                        <i class="fa fa-angle-double-left"></i>
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
                        <i class="fa fa-angle-left"></i>
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

                    <span class="forum-topic-nav__counter
                        forum-topic-nav__counter--right
                        js-forum__total-count"
                    >{{ $topic->postsCount() }}</span>

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
                        <i class="fa fa-angle-right"></i>
                    </span>
                </button>


                <a
                    href="{{ route("forum.topics.show", ["topics" => $topic->topic_id, "end" => $topic->topic_last_post_id]) }}#forum-post-{{ $topic->topic_last_post_id }}"
                    class="js-forum-posts-seek--jump
                        forum-topic-nav__item
                        forum-topic-nav__item--main
                        forum-topic-nav__item--button"
                    data-jump-target="last"
                    data-tooltip-float="fixed"
                    title="{{ trans('forum.topic.jump.last') }}"
                >
                    <span class="forum-topic-nav__item-content">
                        <i class="fa fa-angle-double-right"></i>
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
                        <i class="fa fa-search"></i>
                    </span>
                </a>

                @if (priv_check('ForumTopicReply', $topic)->can())
                    <button
                        type="button"
                        class="btn-osu-big btn-osu-big--forum-reply js-forum-topic-reply--stick"
                    >
                        <span class="btn-osu-big__content">
                            <span class="btn-osu-big__icon">
                                <i class="fa fa-comment"></i>
                            </span>

                            <span class="btn-osu-big__left">
                                <span class="btn-osu-big__text-top">
                                    {{ trans('forum.topics.actions.reply') }}
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
