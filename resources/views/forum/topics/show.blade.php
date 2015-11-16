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
<?php $replyingUser = Auth::check() ? Auth::user() : new App\Models\User() ?>
@extends("master", [
    "title" => "community / {$topic->topic_title}",
    "body_additional_classes" => "forum-colour " . $topic->forum->categorySlug(),
    'canonicalUrl' => route('forum.topics.show', $topic->topic_id),
])

@section("content")
    <div class="forum-topic-headernav js-forum-topic-headernav js-fixed-element">
        <div class="forum-topic-headernav__stripe
            forum-colour__bg-link--{{ $topic->forum->categorySlug() }}
        "></div>

        <div class="osu-layout__row"><div class="forum-topic-headernav__content">
            <div class="forum-topic-headernav__logo">
                @include('objects.logo-menu', ['logoMenuHoverBgClass' => 'forum-colour__bg-link--'.$topic->forum->categorySlug()])
            </div>

            <div class="forum-topic-headernav__titles">
                <div class="forum-topic-headernav__title">
                    @include('forum.topics._header_breadcrumb')
                </div>

                <h1 class="forum-topic-headernav__title">
                    <a href="{{ route("forum.topics.show", $topic->topic_id) }}" class="link--white">
                        {{ $topic->topic_title }}
                    </a>
                </h1>
            </div>

            <div class="forum-topic-headernav__actions">
            </div>
        </div></div>
    </div>

    <div class="osu-layout__row">
        <div
            class="
                forum-category-header
                forum-category-header--topic
                forum-category-header--topic-{{ $topic->forum->categorySlug() }}
            "
            style="background-image: url('{{ $topic->cover !== null ? $topic->cover->fileUrl() : '' }}');"
        ></div>

        <div class="forum-category-header__titles">
            @include('forum.topics._header_breadcrumb', ['headerBreadcrumbExtraClasses' => 'forum-header-breadcrumb--large'])

            <h1 class="forum-category-header__title">
                <a href="{{ route("forum.topics.show", $topic->topic_id) }}" class="link--white link--no-underline">
                    {{ $topic->topic_title }}
                </a>
            </h1>
        </div>

        <div class="forum-topic-header__sticky-marker js-sticky-header" data-sticky-header-target="forum-topic-headernav"></div>
    </div>

    <div class="forum-posts-load-link">
        <a href="{{ route("forum.topics.show", ["topics" => $topic->topic_id, "end" => ($posts->first()->post_id - 1)]) }}" class="js-forum-posts-show-more js-forum__posts-show-more--previous" data-mode="previous">Load more</a>
        <span><i class="fa fa-refresh fa-spin"></i></span>
    </div>

    @include("forum.topics._posts")

    <div class="forum-posts-load-link">
        <a href="{{ post_url($topic->topic_id, $posts->last()->post_id + 1, false) }}" class="js-forum-posts-show-more js-forum__posts-show-more--next" data-mode="next">Load more</a>
        <span><i class="fa fa-refresh fa-spin"></i></span>
    </div>

    <div class="js-forum-topic-reply--container">
        {!! Form::open([
            "url" => route("forum.topics.reply", $topic->topic_id),
            "class" => "forum-post forum-post--reply js-forum-topic-reply",
            "id" => "forum-topic-reply-box",
            "data-remote" => true
        ]) !!}
            <div class="osu-layout__row osu-layout__row--sm2-desktop">
                <div class="forum-post__reply-content">
                    <div class="forum-post__info-panel forum-post__info-panel--reply hidden-xs">
                        <div class="forum-post__avatar-container forum-post__avatar-container--reply">
                            <div
                                class="avatar avatar--full"
                                title="{{ trans("users.show.avatar", ["username" => $replyingUser->username]) }}"
                                style="background-image: url('{{ $replyingUser->user_avatar }}');"
                            ></div>
                        </div>
                    </div>

                    <div class="forum-post__body forum-post__body--reply">
                        <div class="forum-post__content">
                            @include('forum.posts._form_body', ['postBody' => [
                                'focus' => false,
                                'extraClasses' => 'forum-post-content--reply js-forum-topic-reply--input',
                            ]])
                        </div>

                        <div class="forum-post__content forum-post__content forum-post__content--edit-bar">
                            @include("forum.topics._post_box_footer", ["submitText" => trans("forum.topic.post_reply")])
                        </div>
                    </div>

                    <div class="forum-post__actions forum-post__actions--reply">
                        <div class="forum-post-actions">
                            <a href="#" class="js-forum-topic-reply--close forum-post-actions__action hidden">
                                <i class="fa fa-close"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}

    </div>
    <div class="js-sticky-footer" data-sticky-footer-target="forum-topic-reply"></div>
@endsection

@section('fixed-bar-rows-bottom')
    @parent

    <div
        class="js-forum__topic-total-posts forum-topic-nav"
        data-total-count="{{ $topic->postsCount() }}"
    >

        <div class="forum-topic-nav__seek-tooltip js-forum-posts-seek-tooltip">
            <div class="forum-topic-nav__seek-tooltip-number js-forum-posts-seek-tooltip-number"></div>
        </div>

        <div class="js-forum__posts-seek">
            <div class="
                forum-topic-nav__seek-bar
                forum-topic-nav__seek-bar--all
                forum-colour__bg-link--{{ $topic->forum->categorySlug() }}
            "></div>

            <div
                class="
                    js-forum__posts-progress
                    forum-topic-nav__seek-bar
                    forum-colour__bg-link--{{ $topic->forum->categorySlug() }}
                "
                style="width: '{{ 100 * array_get($postsPosition, $jumpTo, 0) / $topic->postsCount() }}%';"
            >
            </div>
        </div>

        <div class="forum-topic-nav__content">
            <div class="forum-topic-nav__group">
            </div>

            <div class="forum-topic-nav__group">
                <a
                    href="{{ route("forum.topics.show", $topic->topic_id) }}"
                    class="js-forum-posts-seek--jump
                        forum-topic-nav__item
                        forum-topic-nav__item--main
                        forum-topic-nav__item--button"
                    data-jump-target="first"
                    title="{{ trans('forum.topic.jump.first') }}"
                >
                    <i class="fa fa-angle-double-left"></i>
                </a>

                <a
                    href="#"
                    class="js-forum-posts-seek--jump
                        forum-topic-nav__item
                        forum-topic-nav__item--main
                        forum-topic-nav__item--button"
                    data-jump-target="previous"
                    title="{{ trans('forum.topic.jump.previous') }}"
                >
                    <i class="fa fa-angle-left"></i>
                </a>

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
                    ">{{ head($postsPosition) }}</span>

                    <span class="forum-topic-nav__counter
                        forum-topic-nav__counter--middle"
                    >/</span>

                    <span class="forum-topic-nav__counter
                        forum-topic-nav__counter--right
                        js-forum__total-count"
                    >{{ $topic->postsCount() }}</span>

                    <div class="js-forum-topic-post-jump--cover forum-topic-nav__counter-cover"></div>
                </div>

                <a
                    href="#"
                    class="js-forum-posts-seek--jump
                        forum-topic-nav__item
                        forum-topic-nav__item--main
                        forum-topic-nav__item--button"
                    data-jump-target="next"
                    title="{{ trans('forum.topic.jump.next') }}"
                >
                    <i class="fa fa-angle-right"></i>
                </a>


                <a
                    href="{{ route("forum.topics.show", ["topics" => $topic->topic_id, "end" => $topic->topic_last_post_id]) }}#forum-post-{{ $topic->topic_last_post_id }}"
                    class="js-forum-posts-seek--jump
                        forum-topic-nav__item
                        forum-topic-nav__item--main
                        forum-topic-nav__item--button"
                    data-jump-target="last"
                    title="{{ trans('forum.topic.jump.last') }}"
                >
                    <i class="fa fa-angle-double-right"></i>
                </a>
            </div>

            <div class="forum-topic-nav__group">
                <a href="#" class="forum-topic-nav__button-circle forum-topic-nav__button-circle--reply js-forum-topic-reply--new">
                    <i class="fa fa-plus"></i>
                </a>
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
