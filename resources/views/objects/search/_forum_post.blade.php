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
                    {{ $title }}
                </div>
            @endif
            <div class="search-forum-post__text search-forum-post__text--excerpt">
                <span class="search-highlight">
                    {!! $highlights !!}
                </span>
            </div>
            <div class="search-forum-post__text search-forum-post__text--footer">
                <a class="search-forum-post__poster js-usercard"
                   @if ($userLink !== null) href="{{ $userLink }}" @endif
                   data-user-id="{{ $user->user_id }}"
                >
                    posted by
                    <span class="search-forum-post__username">{{ $user->username }}</span>
                </a>
                <div class="search-forum-post__url">
                    {{ $link }}
                </div>
                <time class="search-forum-post__time timeago" datetime="{{ $time }}">
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
