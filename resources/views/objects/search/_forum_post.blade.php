{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $userLink = $user->user_id !== null ? route('users.show', $user) : null;
@endphp

<div class="search-forum-post">
    <a class="search-forum-post__link" href="{{ $link }}"></a>
    <div class="search-forum-post__actual">
        <a class="search-forum-post__avatar js-usercard"
           @if ($userLink !== null) href="{{ $userLink }}" @endif
           data-user-id="{{ $user->user_id }}"
        >
            <img class="search-forum-post__avatar-image" src="{{ $user->user_avatar }}">
        </a>
        <div class="search-forum-post__content">
            @if (isset($title))
                <div class="search-forum-post__text search-forum-post__text--title">
                    <span class="search-highlight">
                        {{ $title }}
                    </span>
                </div>
            @endif
            <div class="search-forum-post__text search-forum-post__text--excerpt">
                <span class="search-highlight">
                    {{ $excerpt }}
                </span>
            </div>
            <div class="search-forum-post__text search-forum-post__text--footer">
                <a class="search-forum-post__poster js-usercard"
                   @if ($userLink !== null) href="{{ $userLink }}" @endif
                   data-user-id="{{ $user->user_id }}"
                >
                    {!! osu_trans(
                        'forum.post.posted_by',
                        ['username' => tag(
                            'span',
                            ['class' => 'search-forum-post__username'],
                            $user->username
                        )]
                    ) !!}
                </a>
                <div class="search-forum-post__url">
                    {{ $link }}
                </div>
                <time class="search-forum-post__time js-timeago" datetime="{{ $time }}">
                    {{ $time }}
                </time>
            </div>
        </div>
        <div class="search-forum-post__more">
            <div class="search-result__more-button">
                <span class="fas fa-angle-right"></span>
            </div>
        </div>
    </div>
</div>
