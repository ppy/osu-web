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
<a class="search-entry" href="{{ $link }}">
    <div class="search-forum-post">
        <div class="search-forum-post__avatar">
            <img class="search-forum-post__avatar-image" src="{{ $user->user_avatar }}">
        </div>
        <div class="search-forum-post__content">
            <div class="search-forum-post__text search-forum-post__text--title">
                {{ $title }}
            </div>
            <div class="search-forum-post__text search-forum-post__text--excerpt">
                <span class="search-entry__highlight">
                    {!! $highlights !!}
                </span>
            </div>
            <div class="search-forum-post__text search-forum-post__text--footer">
                <div class="search-forum-post__poster">posted by
                    <span class="search-forum-post__username">{{ $user->username }}</span>
                </div>
                <div class="search-forum-post__link">
                    {{ $link }}
                </div>
                <time class="search-forum-post__time">
                    {{ $time }}
                </time>
            </div>
        </div>
        <div class="search-forum-post__more">
            <div class="search-result__more-button">
                <span class="fa fa-angle-right"></span>
            </div>
        </div>
    </div>
</a>
