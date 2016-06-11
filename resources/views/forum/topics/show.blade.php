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
    <div class="forum-topic-headernav js-forum-topic-headernav js-sync-height--reference" data-sync-height-target="forum-topic-headernav" data-visibility="hidden">
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

    @include('forum.topics._header')

    <div class="js-header--alt js-sync-height--target" data-sync-height-id="forum-topic-headernav"></div>

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

    <div class="forum-posts-load-link js-header--alt">
        <a href="{{ route("forum.topics.show", ["topics" => $topic->topic_id, "end" => ($posts->first()->post_id - 1)]) }}" class="js-forum-posts-show-more js-forum__posts-show-more--previous" data-mode="previous">Load more</a>
        <span><i class="fa fa-refresh fa-spin"></i></span>
    </div>

    @include("forum.topics._posts")

    <div class="forum-posts-load-link {{ last($postsPosition) === $topic->postsCount() ? 'hidden' : '' }}">
        <a href="{{ post_url($topic->topic_id, $posts->last()->post_id + 1, false) }}" class="js-forum-posts-show-more js-forum__posts-show-more--next" data-mode="next">Load more</a>
        <span><i class="fa fa-refresh fa-spin"></i></span>
    </div>

    <div class="js-forum-topic-reply--container js-sync-height--target" data-sync-height-id="forum-topic-reply">
        {!! Form::open([
            "url" => route("forum.topics.reply", $topic->topic_id),
            "class" => "forum-post forum-post--reply js-forum-topic-reply js-sync-height--reference js-fixed-element js-editor-zoom",
            "id" => "forum-topic-reply-box",
            "data-remote" => true,
            "data-sync-height-target" => "forum-topic-reply",
            'data-force-reload' => Auth::check() === false ? '1' : '0',
        ]) !!}
            <div class="forum-post__reply-container">
                <div class="osu-layout__row osu-layout__row--sm2-desktop osu-layout__row--full-height">
                    <div class="forum-post__reply-content">
                        <div class="forum-post__info-panel forum-post__info-panel--reply hidden-xs">
                            <div class="forum-post__avatar-container forum-post__avatar-container--reply">
                                @if (Auth::check() === true)
                                    <div
                                        class="avatar avatar--full"
                                        style="background-image: url('{{ Auth::user()->user_avatar }}');"
                                    ></div>
                                @else
                                    <div class="avatar avatar--full avatar--guest"></div>
                                @endif
                            </div>
                        </div>

                        <div class="forum-post__body forum-post__body--reply">
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

                        <div class="forum-post__actions forum-post__actions--reply js-editor-zoom--hidden">
                            <div class="forum-post-actions">
                                <a href="#" class="js-forum-topic-reply--close forum-post-actions__action hidden">
                                    <i class="fa fa-close"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}

    </div>
    <div class="js-sticky-footer" data-sticky-footer-disabled="1" data-sticky-footer-target="forum-topic-reply"></div>
@endsection

@section('permanent-fixed-footer')
    @parent

    <div
        class="js-forum__topic-total-posts forum-topic-nav"
        data-total-count="{{ $topic->postsCount() }}"
    >

        <div class="forum-topic-nav__seek-tooltip js-forum-posts-seek--tooltip" data-visibility="hidden">
            <div class="forum-topic-nav__seek-tooltip-number js-forum-posts-seek-tooltip-number">0</div>
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
                @if ($topic->isLocked())
                    <span
                        class="forum-topic-nav__button-circle forum-topic-nav__button-circle--blank"
                        data-tooltip-float="fixed"
                        title="{{ trans('forum.topics.lock.is_locked') }}"
                    >
                        <i class="fa fa-lock"></i>
                    </span>
                @endif

                @if (priv_check('ForumTopicLock', $topic)->can())
                    <a
                        class="forum-topic-nav__button-circle"
                        href="{{ route('forum.topics.lock', [
                            $topic,
                            'lock' => ($topic->isLocked() === true ? '0' : null),
                        ]) }}"
                        data-remote="1"
                        data-method="post"
                        data-reload-on-success="1"
                        data-reload-reset-scroll="1"
                    >
                        @if ($topic->isLocked())
                            <i class="fa fa-unlock"></i>
                        @else
                            <i class="fa fa-lock"></i>
                        @endif
                    </a>
                @endif

                @if (priv_check('ForumTopicLock', $topic)->can())
                    <button
                        class="forum-topic-nav__button-circle"
                        data-target="#forum-topic-move-modal"
                        data-toggle="modal"
                        type="button"
                        title="{{ trans('forum.topic.move') }}"
                    >
                        <i class="fa fa-internet-explorer"></i>
                    </button>
                @endif
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
                    <i class="fa fa-angle-double-left"></i>
                </a>

                <a
                    href="#"
                    class="js-forum-posts-seek--jump
                        forum-topic-nav__item
                        forum-topic-nav__item--main
                        forum-topic-nav__item--button"
                    data-jump-target="previous"
                    data-tooltip-float="fixed"
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

                    <div
                        class="js-forum-topic-post-jump--cover forum-topic-nav__counter-cover"
                        data-tooltip-float="fixed"
                        title="{{ trans('forum.topic.jump.enter') }}"
                    ></div>
                </div>

                <a
                    href="#"
                    class="js-forum-posts-seek--jump
                        forum-topic-nav__item
                        forum-topic-nav__item--main
                        forum-topic-nav__item--button"
                    data-jump-target="next"
                    data-tooltip-float="fixed"
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
                    data-tooltip-float="fixed"
                    title="{{ trans('forum.topic.jump.last') }}"
                >
                    <i class="fa fa-angle-double-right"></i>
                </a>
            </div>

            <div class="forum-topic-nav__group forum-topic-nav__group--right">
                <a
                    href="#"
                    class="forum-topic-nav__button-circle forum-topic-nav__button-circle--reply js-forum-topic-reply--new"
                    data-tooltip-float="fixed"
                    title="{{ trans('forum.topics.actions.reply') }}"
                >
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

    @if (priv_check('ForumTopicMove', $topic)->can())
        <div id="forum-topic-move-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body modal-body--page">
                        {!! Form::open(['url' => route('forum.topics.move', $topic->topic_id), 'data-remote' => true]) !!}
                            <select name="destination_forum_id">
                                @foreach (App\Models\Forum\Forum::moveDestination()->get() as $forum)
                                    <option value="{{ $forum->getKey() }}"
                                        {{ $forum->isOpen() ? '' : 'disabled' }}
                                    >
                                        @for ($i = 0; $i < $forum->currentDepth(); $i++)
                                            -
                                        @endfor
                                        {{ $forum->forum_name }}
                                    </option>
                                @endforeach
                            </select>

                            <p>
                                <button>{{ trans('common.buttons.save') }}</button>
                            </p>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
