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
@extends('master', [
    'currentSection' => 'home',
])

@section('content')
    @include('home._user_header_default', ['title' => trans('forum.topic_watches.index.title_compact')])

    <div class="osu-page osu-page--info-bar">
        <div class="grid-items">
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ trans('forum.topic_watches.index.box.total') }}
                </div>
                <div class="counter-box__count">
                    {{ i18n_number_format($counts['total']) }}
                </div>
            </div>

            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ trans('forum.topic_watches.index.box.unread') }}
                </div>
                <div class="counter-box__count">
                    {{ i18n_number_format($counts['unread']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="osu-page osu-page--forum-topic-watches-list osu-page--full">
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
