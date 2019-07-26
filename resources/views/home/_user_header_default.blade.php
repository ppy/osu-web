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
    $stats ?? $stats = new App\Libraries\CurrentStats();
@endphp
<div class="osu-page osu-page--header">
    @include('home._user_header_nav')

    <div class="osu-page-header osu-page-header--two-col osu-page-header--home-user js-current-user-cover">
        <div class="osu-page-header__box osu-page-header__box--two-col">
            <h1 class="osu-page-header__title u-ellipsis-overflow">
                {!! $title !!}
            </h1>
            <p class="osu-page-header__detail">
                <a class="osu-page-header__link" href="{{ osu_url('user.inbox') }}">
                    {{ trans_choice('home.user.header.messages', Auth::user()->notificationCount()) }}
                </a>
            </p>
        </div>

        <div class="osu-page-header__box osu-page-header__box--status osu-page-header__box--graph">
            <div class="osu-page-header__status">
                <div class="osu-page-header__status-label">
                    {{ trans('home.user.header.stats.friends') }}
                </div>
                <div class="js-forum-topic-watch--unread osu-page-header__status-text">
                    {{ i18n_number_format($stats->onlineFriends) }}
                </div>
            </div>

            <div class="osu-page-header__status">
                <div class="osu-page-header__status-label">
                    {{ trans('home.user.header.stats.games') }}
                </div>
                <div class="js-forum-topic-watch--unread osu-page-header__status-text">
                    {{ i18n_number_format($stats->currentGames) }}
                </div>
            </div>

            <div class="osu-page-header__status">
                <div class="osu-page-header__status-label">
                    {{ trans('home.user.header.stats.online') }}
                </div>
                <div class="osu-page-header__status-text">
                    <strong>{{ i18n_number_format($stats->currentOnline) }}</strong>
                </div>
            </div>

            <div class="js-fancy-graph osu-page-header__status-chart" data-src="banchostats"></div>
            <script id="banchostats" type="application/json">{!! json_encode($stats->graphData) !!}</script>
        </div>
    </div>
</div>
