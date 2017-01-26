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
@extends('master')

@section('content')
    <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1 osu-layout__row--full t-forum-category-osu">
        <div class="osu-layout__sub-row osu-layout__sub-row--lg1-compact ">
            @include('home._user_header_nav')

            <div class="osu-page-header osu-page-header--home-user js-current-user-cover">
                <div class="osu-page-header__box">
                    <h1 class="osu-page-header__title osu-page-header__title--slightly-small">
                        Hello, {{Auth::user()->username}}!
                    </h1>
                    <p class="osu-page-header__detail">
                        You have 0 new notifications
                    </p>
                    <p class="osu-page-header__detail">
                        You have 0 new messages
                    </p>
                </div>

                <div class="osu-page-header__box osu-page-header__box--status">
                    <div class="osu-page-header__status">
                        <div class="osu-page-header__status-label">
                            Online Friends
                        </div>
                        <div class="js-forum-topic-watch--total osu-page-header__status-text">
                            0
                        </div>
                    </div>
                    <div class="osu-page-header__status">
                        <div class="osu-page-header__status-label">
                            Online Users
                        </div>
                        <div class="js-forum-topic-watch--unread osu-page-header__status-text">
                            0
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="user-news" style="padding: 20px; background: #333333;">
            <h2 style="margin: 0px; font-size: 20px; margin-bottom: 10px; margin-left: 10px; color: #FF99CC; font-weight: 100;">News</h2>
            <div class="news-posts" style="max-width: 432px;">
                @foreach ($news->posts as $post)
                    <div class="news-post-preview{{ $loop->iteration > 3 ? ' news-post-preview--collapsed' : '' }}">
                        <div class="news-post-preview__image"><img src="https://placehold.it/430x130"></div>
                        <div class="news-post-preview__body">
                            <div class="news-post-preview__post-date">
                                <div class="news-post-preview__date">{{ Carbon\Carbon::parse($post->date)->formatLocalized('%d') }}</div>
                                <div class="news-post-preview__month-year">{{ Carbon\Carbon::parse($post->date)->formatLocalized($loop->iteration > 3 ? '&nbsp;%b' : '%b %Y') }}</div>
                            </div>
                            <div class="news-post-preview__post-right">
                                <div class="news-post-preview__post-title u-ellipsis-overflow">
                                    {{$post->title}}
                                </div>
                                <div class="news-post-preview__post-content">{!! $post->body_abstract !!}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
