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
                <a class="osu-page-header__link" href="{{ route('notifications.index') }}">
                    {{ trans_choice('home.user.header.messages', number_format(Auth::user()->notificationCount())) }}
                </a>
            </p>
        </div>

        <div class="osu-page-header__box osu-page-header__box--status osu-page-header__box--graph">
            <div class="osu-page-header__status osu-page-header__status--fade-in">
                <div class="osu-page-header__status-label">
                    Games
                </div>
                <div class="js-forum-topic-watch--unread osu-page-header__status-text">
                    {{ number_format($stats->currentGames) }}
                </div>
            </div>

            <div class="osu-page-header__status osu-page-header__status--fade-in">
                <div class="osu-page-header__status-label">
                    {{ trans('home.user.header.stats.online') }}
                </div>
                <div class="osu-page-header__status-text">
                    <strong>{{ number_format($stats->currentOnline) }}</strong>
                </div>
            </div>

            <div class="js-fancy-graph osu-page-header__status-chart" data-src="banchostats"></div>
            <script id="banchostats" type="application/json">{!! json_encode($stats->graphData) !!}</script>
        </div>
    </div>
</div>
