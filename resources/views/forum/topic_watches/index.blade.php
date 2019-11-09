{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    <div class="osu-layout__row osu-layout__row--page-compact osu-layout__row--sm1 osu-layout__row--full">
        <div class="osu-layout__sub-row osu-layout__sub-row--lg1-compact">
            @include('home._user_header_nav')

            <div class="osu-page-header osu-page-header--home-user js-current-user-cover">
                <div class="osu-page-header__box">
                    <h1 class="osu-page-header__title">
                        {!! trans('forum.topic_watches.index.title_main') !!}
                    </h1>
                </div>

                <div class="osu-page-header__box osu-page-header__box--status">
                    <div class="osu-page-header__status">
                        <div class="osu-page-header__status-label">
                            {{ trans('forum.topic_watches.index.box.total') }}
                        </div>
                        <div class="js-forum-topic-watch--total osu-page-header__status-text">
                            {{ i18n_number_format($counts['total']) }}
                        </div>
                    </div>

                    <div class="osu-page-header__status">
                        <div class="osu-page-header__status-label">
                            {{ trans('forum.topic_watches.index.box.unread') }}
                        </div>
                        <div class="js-forum-topic-watch--unread osu-page-header__status-text">
                            {{ i18n_number_format($counts['unread']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="forum-list">
            <ul class="forum-list__items">
                @include('forum.forums._topics', [
                    'row' => 'forum.topic_watches._topic',
                    'topics' => $topics,
                ])
            </ul>
        </div>

        @include('objects._pagination_v2', ['object' => $topics, 'modifiers' => ['light-bg']])
    </div>
@endsection
