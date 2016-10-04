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
@extends("master", [
    'current_section' => 'ranking',
])

@section("content")
    <div class="osu-layout__row osu-layout__row--page-compact">
        <div class="osu-page-header osu-page-header--ranking">
            <div class="osu-page-header__title-box">
                <h2 class="osu-page-header__title osu-page-header__title--small">{{ trans("ranking.header.ranking") }}</h2>
                <h2 class="osu-page-header__title">{{ trans("ranking.header.country") }}</h1>
            </div>
        </div>
    </div>

    <div class="osu-layout__row">
        <div class="page-extra ranking-scoreboard">
            <div class="ranking-scoreboard__header">
                <h3>
                    {{ trans('ranking.header.country') }}
                </h3>
            </div>

            <div class="ranking-scoreboard__main">
                <div class="ranking-scoreboard__row">
                    @foreach (['rank-header', 'country-header', 'user-count', 'play-count', 'country-score', 'country-performance'] as $m)
                        <span class="ranking-scoreboard__row-item ranking-scoreboard__row-item--{{ $m }} ranking-scoreboard__row-item--header {{ $m == 'play-count' || $m == 'user-count' ? 'hidden-xs' : '' }}">
                            {{ trans("ranking.list.$m") }}
                        </span>
                    @endforeach
                </div>

                @for($i = 0; $i < count($stats); $i++)
                    @include(
                        'ranking._country-item',
                        [
                            'stat' => $stats[$i],
                            'position' => ($stats->firstItem() + $i),
                        ]
                    )
                @endfor
            </div>

            @include('ranking._pagination', ['object' => $stats])
        </div>
    </div>
@endsection
