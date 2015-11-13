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
                    <ol class="
                        forum-topic-headernav__breadcrumb
                        forum-colour__bg-link--{{ $topic->forum->categorySlug() }}
                    ">
                        <li class="forum-topic-headernav__breadcrumb-item">
                            <a href="{{ route('forum.forums.index') }}"
                                class="forum-topic-headernav__nav-link"
                            >
                                {{ trans('forum.title') }}
                            </a>
                        </li>

                        @foreach ($topic->forum->forum_parents as $forumId => $forumData)
                            <li class="forum-topic-headernav__breadcrumb-item">
                                <a href=
                                    @if ($forumData[1] === 0)
                                        "{{ route('forum.forums.index') }}#forum-{{ $forumId }}"
                                    @else
                                        "{{ route('forum.forums.show', $forumId) }}"
                                    @endif
                                    class="forum-topic-headernav__nav-link"
                                >
                                    {{ $forumData[0] }}
                                </a>
                            </li>
                        @endforeach

                        <li class="forum-topic-headernav__breadcrumb-item">
                            <a href="{{ route("forum.forums.show", $topic->forum->forum_id) }}"
                                class="forum-topic-headernav__nav-link"
                            >
                                {{ $topic->forum->forum_name }}
                            </a>
                        </li>
                    </ol>
                </div>

                <h1 class="forum-topic-headernav__title">
                    <a href="{{ route("forum.topics.show", $topic->topic_id) }}" class="forum-topic-headernav__nav-link">
                        {{ $topic->topic_title }}
                    </a>
                </h1>
            </div>

            <div class="forum-topic-headernav__actions">
            </div>
        </div></div>
    </div>

    <div class="osu-layout__row osu-layout__row--page-compact">
        <div class="forum-header
            forum-category-header
            forum-category-header--{{ $topic->forum->categorySlug() }}
            forum-category-header--main
        ">
            <div class="topic-header">
                <ol class="breadcrumb forums-breadcrumb">
                    @include("forum.forums._nav", ["forum_parents" => $topic->forum->forum_parents])
                    <li>
                        <a href="{{ route("forum.forums.show", $topic->forum->forum_id) }}">
                            {{ $topic->forum->forum_name }}
                        </a>
                    </li>
                </ol>
                <h1>
                    <a href="{{ route("forum.topics.show", $topic->topic_id) }}">
                        {{ $topic->topic_title }}
                    </a>
                </h1>
            </div>
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

    @if ($topic->canBeRepliedBy(Auth::user()))
        {!! Form::open(["url" => route("forum.topics.reply", $topic->topic_id), "class" => "osu-layout__row osu-layout__row--sm2-desktop post-editor", "id" => "forum-topic-reply-box", "data-remote" => true]) !!}
            <div class="forum-small-row post-editor__main post-editor__main--reply">
                <div class="forum__avatar-container forum__avatar-container--reply hidden-xs">
                    <div
                        class="avatar avatar--full"
                        title="{{ trans("users.show.avatar", ["username" => Auth::user()->username]) }}"
                        style="background-image: url('{{ Auth::user()->user_avatar }}');"
                    ></div>
                </div>

                @include('forum.posts._form_body', ['postBody' => ['focus' => false]])
            </div>

            <div class="forum-small-row post-editor__footer">
                @include("forum.topics._post_box_footer", ["submitText" => trans("forum.topic.post_reply")])
            </div>
        {!! Form::close() !!}
    @endif
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

        <div class="js-forum__posts-seek forum-topic-nav__seek-bar-container">
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
                <div class="forum-topic-nav__item">
                </div>
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
