{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'pageDescription' => $forum->toMetaDescription(),
    'searchParams' => [
        'forum_id' => $forum->getKey(),
        'mode' => 'forum_post',
    ],
    'titlePrepend' => $forum->forum_name,
])

@section('content')
    @include('forum._header', [
        'background' => $cover['fileUrl'] ?? null,
        'forum' => $forum,
    ])

    <div class="osu-page osu-page--forum t-forum-{{ $forum->categorySlug() }}">
        <div class="forum-title forum-title--forum u-forum--before-bg">
            <h1 class="forum-title__name">
                <a class="link--white link--no-underline" href="{{ route("forum.forums.show", $forum->getKey()) }}">
                    {{ $forum->forum_name }}
                </a>
            </h1>
            <p class="forum-title__description">
                {{ $forum->forum_desc }}
            </p>
        </div>

        @if ($forum->subforums()->exists())
            <div class="forum-list">
                <h2 class="title title--no-margin">{{ osu_trans("forum.subforums") }}</h2>

                <ul class="forum-list__items">
                    @foreach ($forum->subforums as $subforum)
                        @include('forum.forums._forum', ['forum' => $subforum])
                    @endforeach
                </ul>
            </div>
        @endif

        @if (count($pinnedTopics) > 0)
            <div class="forum-list">
                <div class="forum-list__header">
                    <h2 class="title title--no-margin">
                        {{ osu_trans('forum.pinned_topics') }}
                    </h2>
                </div>

                <ul class="forum-list__items">
                    @include('forum.forums._topics', ['topics' => $pinnedTopics])
                </ul>
            </div>
        @endif

        @if (count($topics) > 0 || $forum->isOpen())
            <div id="topics" class="forum-list">
                <div class="forum-list__header">
                    <h2 class="title title--no-margin">
                        {{ osu_trans('forum.topics._') }}
                    </h2>

                    <div class="forum-list__menu">
                        @php
                            $menuId = "forum-{$forum->getKey()}";
                        @endphp
                        <button class="forum-list__menu-button js-click-menu" data-click-menu-target="{{ $menuId }}">
                            <span class="fas fa-ellipsis-v"></span>
                        </button>

                        <div
                            class="simple-menu simple-menu--forum-list js-click-menu"
                            data-visibility="hidden"
                            data-click-menu-id="{{ $menuId }}"
                        >
                            @include('forum.forums._new_topic', ['blockClass' => 'simple-menu__item', 'forum' => $forum, 'withIcon' => false])
                            @include('forum.forums._mark_as_read', ['blockClass' => 'simple-menu__item', 'forum' => $forum])
                        </div>
                    </div>
                </div>

                <div class="forum-list__buttons">
                    <div class="forum-list__button">
                        @include('forum.forums._new_topic', compact('forum'))
                    </div>
                    <div class="forum-list__button">
                        @include('forum.forums._mark_as_read', compact('forum'))
                    </div>
                </div>

                @include('forum.forums._topics_sort', compact('forum'))

                <ul class="forum-list__items">
                    @include('forum.forums._topics', compact('topics'))
                </ul>

                @if (count($topics) > 0)
                    <div class="forum-list__buttons">
                        <div class="forum-list__button">
                            @include('forum.forums._new_topic', compact('forum'))
                        </div>
                        <div class="forum-list__button">
                            @include('forum.forums._mark_as_read', compact('forum'))
                        </div>
                    </div>
                @endif

                @include('objects._pagination_v2', [
                    'object' => $topics
                        ->fragment('topics')
                        ->appends([
                            'sort' => request('sort'),
                            'with_replies' => request('with_replies'),
                        ]),
                    'modifiers' => ['forum'],
                ])
            </div>
        @endif
    </div>

    @if (auth()->check() && auth()->user()->isAdmin())
        <div class="admin-menu">
            <button class="admin-menu__button js-menu" data-menu-target="admin-menu-forums-show">
                <span class="fas fa-angle-up"></span>
                <span class="admin-menu__button-icon fas fa-tools"></span>
            </button>

            <div class="admin-menu__menu js-menu" data-menu-id="admin-menu-forums-show" data-visibility="hidden">
                <a class="admin-menu-item" href="{{ route('admin.forum.forum-covers.index').'#forum-'.$forum->getKey()  }}">
                    <span class="admin-menu-item__content">
                        <span class="admin-menu-item__label admin-menu-item__label--icon">
                            <span class="fas fa-pencil-alt"></span>
                        </span>

                        <span class="admin-menu-item__label admin-menu-item__label--text">
                            Edit cover
                        </span>
                    </span>
                </a>
            </div>
        </div>
    @endif
@endsection
