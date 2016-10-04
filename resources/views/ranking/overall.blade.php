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
                <h2 class="osu-page-header__title">{{ trans("ranking.header.overall") }}</h1>
            </div>
        </div>
    </div>

    <div class="osu-layout__row">
        <div class="page-extra ranking-scoreboard">
            <div class="ranking-scoreboard__header">
                <h3>
                    @if ($currentCountry === 'all')
                        {{ trans('ranking.overall.global') }}
                    @else
                        {{ trans('ranking.overall.national',
                        ['country' => $countries['data'][array_search($currentCountry, array_column($countries['data'], 'code'))]['name']]) }}
                        <img
                            class="flag-country"
                            src="/images/flags/{{ $currentCountry }}.png"
                            alt="{{ $currentCountry }}"
                        />
                    @endif
                </h3>
            </div>

            <div class="ranking-scoreboard__countries-flags">
                @if ($currentCountry !== 'all')
                    <div>
                        {{
                            link_to_route(
                                'ranking-overall',
                                trans('ranking.overall.reset')
                            )
                        }}
                    </div>
                @endif
                <div class="ranking-scoreboard__top-flags">
                    @for ($i = 0; $i < count($topCountries); $i++)
                        <a
                            href="{{ route('ranking-overall', ['country' => $topCountries[$i]->acronym]) }}"
                            @if ($i >= 5)
                                class="hidden-xs"
                            @endif
                        >
                            <img
                                class="flag-country"
                                src="/images/flags/{{ $topCountries[$i]->acronym }}.png"
                                alt="{{ $topCountries[$i]->acronym }}"
                                title="{{ $topCountries[$i]->name }}"
                            />
                        </a>
                    @endfor
                    {{
                        link_to_route(
                            'ranking-country',
                            '...',
                            [],
                            ['title' => trans('ranking.overall.more')]
                        )
                    }}
                </div>
            </div>

            @if ($currentUser && $currentUser->isSupporter() && false)
                <div class="ranking-scoreboard__friends">
                    <label class="osu-checkbox"><input type="checkbox" class="osu-checkbox__input" value="on"><span class="osu-checkbox__tick"><span class="fa fa-check"></span></span></label>
                    {{ trans('ranking.friends') }}
                </div>
            @endif

            @include(
                'ranking._tabs',
                [
                    'type' => 'overall',
                    'currentMode' => $currentMode,
                    'currentCountry' => $currentCountry,
                ]
            )

            <div class="ranking-scoreboard__main">
                <div class="ranking-scoreboard__row">
                    @foreach (['rank-header', 'player-header', 'accuracy', 'play-count', 'score', 'x-count', 's-count', 'a-count'] as $m)
                        <span class="ranking-scoreboard__row-item ranking-scoreboard__row-item--{{ $m }} ranking-scoreboard__row-item--header {{ $m == 'play-count' || $m == 'x-count' || $m == 's-count' || $m == 'a-count' ? 'hidden-xs' : '' }}">
                            {{ trans("ranking.list.$m") }}
                        </span>
                    @endforeach
                </div>

                @foreach($stats as $stat)
                    @include(
                        'ranking._overall-item',
                        [
                            'stat' => $stat,
                            'currentUser' => $currentUser,
                            'currenCountry' => $currentCountry,
                        ]
                    )
                @endforeach
            </div>

            @include('ranking._pagination', ['object' => $stats])
        </div>
    </div>
@endsection
