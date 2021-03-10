{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@section('forum-topic-moderation-menu')
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
@endsection

<div class="forum-topic-nav u-fancy-scrollbar">
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
        <div class="forum-topic-nav__mobile-float">
            @include('forum.topics._watch', ['topic' => $topic, 'state' => $watch])
        </div>

        @if ($userCanModerate)
            <div class="forum-topic-nav__mobile-float forum-topic-nav__mobile-float--right">
                <div
                    class="btn-circle btn-circle--topic-nav js-menu"
                    data-menu-target="topic-moderation-mobile"
                >
                    <div class="btn-circle__content">
                        <span class="fas fa-ellipsis-v"></span>
                    </div>
                </div>
                <div
                    class="js-menu simple-menu simple-menu--forum-topic-moderation"
                    data-menu-id="topic-moderation-mobile"
                    data-visibility="hidden"
                >
                    <div class="simple-menu__content">
                        @yield('forum-topic-moderation-menu')
                    </div>
                </div>
            </div>
        @endif

        <div class="forum-topic-nav__group forum-topic-nav__group--desktop">
            @yield('forum-topic-moderation-menu')
            @include('forum.topics._watch', ['topic' => $topic, 'state' => $watch])
        </div>

        <div class="forum-topic-nav__group forum-topic-nav__group--mobile">
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
        </div>

        <div class="forum-topic-nav__group forum-topic-nav__group--main">
            <a
                href="{{ route("forum.topics.show", $topic->topic_id) }}"
                class="js-forum-posts-seek--jump btn-circle btn-circle--topic-nav"
                data-jump-target="first"
                data-tooltip-float="fixed"
                title="{{ trans('forum.topic.jump.first') }}"
            >
                <span class="btn-circle__content">
                    <i class="fas fa-angle-double-left"></i>
                </span>
            </a>

            <button
                type="button"
                class="js-forum-posts-seek--jump btn-circle btn-circle--topic-nav"
                data-jump-target="previous"
                data-tooltip-float="fixed"
                title="{{ trans('forum.topic.jump.previous') }}"
            >
                <span class="btn-circle__content">
                    <i class="fas fa-angle-left"></i>
                </span>
            </button>

            <div class="
                forum-topic-nav__counter-container
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
                    data-total="{{ $topic->postCount() }}"
                >{{ i18n_number_format($topic->postCount()) }}</span>

                <div
                    class="js-forum-topic-post-jump--cover forum-topic-nav__counter-cover"
                    data-tooltip-float="fixed"
                    title="{{ trans('forum.topic.jump.enter') }}"
                ></div>
            </div>

            <button
                type="button"
                class="js-forum-posts-seek--jump btn-circle btn-circle--topic-nav"
                data-jump-target="next"
                data-tooltip-float="fixed"
                title="{{ trans('forum.topic.jump.next') }}"
            >
                <span class="btn-circle__content">
                    <i class="fas fa-angle-right"></i>
                </span>
            </button>

            <a
                href="{{ route('forum.topics.show', ['topic' => $topic, 'end' => $topic->topic_last_post_id]) }}#forum-post-{{ $topic->topic_last_post_id }}"
                class="js-forum-posts-seek--jump btn-circle btn-circle--topic-nav"
                data-jump-target="last"
                data-tooltip-float="fixed"
                title="{{ trans('forum.topic.jump.last') }}"
            >
                <span class="btn-circle__content">
                    <i class="fas fa-angle-double-right"></i>
                </span>
            </a>
        </div>

        <div
            class="forum-topic-nav__group forum-topic-nav__group--mobile js-forum-topic-lock--state"
            data-topic-id="{{ $topic->getKey() }}"
            data-topic-lock="{{ $topic->isLocked() ? '1' : '0' }}"
        >
            <div class="forum-topic-nav__lock-or-reply forum-topic-nav__lock-or-reply--lock">
                <div
                    class="btn-circle btn-circle--topic-nav btn-circle--blank"
                    data-tooltip-float="fixed"
                    title="{{ trans('forum.topics.lock.is_locked') }}"
                >
                    <span class="btn-circle__content">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
            </div>
            <div class="forum-topic-nav__lock-or-reply forum-topic-nav__lock-or-reply--reply">
                @if (Auth::check())
                    <button
                        type="button"
                        class="btn-circle btn-circle--topic-nav js-forum-topic-reply--toggle"
                        data-tooltip-float="fixed"
                        title="{{ trans('forum.topics.actions.reply') }}"
                    >
                        <span class="btn-circle__content">
                            <i class="fas fa-reply"></i>
                        </span>
                    </button>
                @else
                    <button
                        type="button"
                        class="btn-circle btn-circle--topic-nav js-user-link"
                        data-tooltip-float="fixed"
                        title="{{ trans('forum.topics.actions.login_reply') }}"
                    >
                        <span class="btn-circle__content">
                            <i class="fas fa-reply"></i>
                        </span>
                    </button>
                @endif
            </div>
        </div>

        <div class="forum-topic-nav__group forum-topic-nav__group--right forum-topic-nav__group--desktop">
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
