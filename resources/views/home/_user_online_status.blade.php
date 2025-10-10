{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $stats = $stats ?? new App\Libraries\CurrentStats;
@endphp
<div class="user-online-status">
    <div>
        <div class="user-online-status__label">
            {{ osu_trans('home.user.header.stats.friends') }}
        </div>
        <div class="user-online-status__value">
            {{ i18n_number_format($stats->onlineFriends) }}
        </div>
    </div>

    <div>
        <div class="user-online-status__label">
            {{ osu_trans('home.user.header.stats.games') }}
        </div>
        <div class="user-online-status__value">
            {{ i18n_number_format($stats->currentGames) }}
        </div>
    </div>

    <div>
        <div class="user-online-status__label">
            {{ osu_trans('home.user.header.stats.online') }}
        </div>
        <div class="user-online-status__value">
            <strong>{{ i18n_number_format($stats->currentOnline) }}</strong>
        </div>
    </div>

    <div
        class="js-fancy-graph user-online-status__chart"
        data-chart-data="{{ json_encode($stats->graphData) }}"
    ></div>
</div>
