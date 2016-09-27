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
@extends('master')

@section('content')
    <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1 osu-layout__row--full t-forum-category-osu">
        <div class="osu-layout__sub-row osu-layout__sub-row--lg1-compact ">
            @include('home._user_header_nav')

            <div class="osu-page-header osu-page-header--home-user js-current-user-cover">
                <div class="osu-page-header__box">
                    <h1 class="osu-page-header__title osu-page-header__title--slightly-small">
                        {{ trans('forum.topic_watches.index.title') }}
                    </h1>

                    <p class="osu-page-header__detail">
                        {!! trans('forum.topic_watches.index.info.total', [
                            'total' =>
                                '<span class="js-forum-topic-watch--total">'.
                                count($topics).
                                '</span>',
                        ]) !!}
                    </p>

                    <p class="osu-page-header__detail">
                        {!! trans('forum.topic_watches.index.info.unread', [
                            'unread' =>
                                '<span class="js-forum-topic-watch--unread">'.
                                (count($topics) - count($topicReadStatus)).
                                '</span>',
                        ]) !!}
                    </p>
                </div>

                <div class="osu-page-header__box osu-page-header__box--status">
                    <div class="osu-page-header__status">
                        <div class="osu-page-header__status-label">
                            {{ trans('forum.topic_watches.index.box.total') }}
                        </div>
                        <div class="js-forum-topic-watch--total osu-page-header__status-text">
                            {{ count($topics) }}
                        </div>
                    </div>

                    <div class="osu-page-header__status">
                        <div class="osu-page-header__status-label">
                            {{ trans('forum.topic_watches.index.box.unread') }}
                        </div>
                        <div class="js-forum-topic-watch--unread osu-page-header__status-text">
                            {{ count($topics) - count($topicReadStatus) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('forum.forums._topics', [
            'title' => trans('forum.topic_watches.index.title'),
            'row' => 'forum.topic_watches._topic',
        ])
    </div>
@endsection
