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
    $stats = $stats ?? new App\Libraries\CurrentStats;
@endphp
<div class="user-online-status">
    <div class="user-online-status__item">
        <div class="user-online-status__label">
            {{ trans('home.user.header.stats.friends') }}
        </div>
        <div class="user-online-status__value">
            {{ i18n_number_format($stats->onlineFriends) }}
        </div>
    </div>

    <div class="user-online-status__item">
        <div class="user-online-status__label">
            {{ trans('home.user.header.stats.games') }}
        </div>
        <div class="user-online-status__value">
            {{ i18n_number_format($stats->currentGames) }}
        </div>
    </div>

    <div class="user-online-status__item">
        <div class="user-online-status__label">
            {{ trans('home.user.header.stats.online') }}
        </div>
        <div class="user-online-status__value">
            <strong>{{ i18n_number_format($stats->currentOnline) }}</strong>
        </div>
    </div>

    <div
        class="js-fancy-graph user-online-status__item user-online-status__item--chart"
        data-src="banchostats"
    ></div>
    <script id="banchostats" type="application/json">{!! json_encode($stats->graphData) !!}</script>
</div>
