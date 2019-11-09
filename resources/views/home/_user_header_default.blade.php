{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
