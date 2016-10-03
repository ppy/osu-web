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
                    @endif
                </h3>
            </div>
            <div class="ranking-scoreboard__tabs">
                @foreach (['osu', 'taiko', 'mania', 'fruits'] as $mode)
                    {{
                        link_to_route(
                            'ranking-overall',
                            trans("beatmaps.mode.$mode"),
                            [
                                'country' => $currentCountry,
                                'mode' => $mode,
                            ],
                            ['class' => 'ranking-scoreboard__tab' . ($mode === $currentMode ? ' ranking-scoreboard__tab--active' : '')]
                        )
                    }}
                @endforeach
            </div>
            <div class="ranking-scoreboard__line">
            </div>
            <div class="ranking-scoreboard__main">
                <div class="ranking-scoreboard__row">
                    @foreach (['rank-header', 'player-header', 'accuracy', 'play-count', 'score', 'x-count', 's-count', 'a-count'] as $m)
                        <span class="ranking-scoreboard__row-item ranking-scoreboard__row-item--{{ $m }} ranking-scoreboard__row-item--header {{ $m == 'play-count' || $m == 'x-count' || $m == 's-count' || $m == 'a-count' ? 'hidden-xs' : '' }}">
                            {{ trans("ranking.list.$m") }}
                        </span>
                    @endforeach
                </div>
                @foreach($stats as $stat)
                    <div class="ranking-scoreboard__row ranking-scoreboard__row--score {{ $stat->user->user_id == $currentUser->user_id ? 'ranking-scoreboard__row--myself' : '' }}">
                        <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--rank">
                            #{{ $stat->rank_score_index }}
                        </div>
                        <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--flag" id="id{{ $stat['rank']['global'] }}">
                            @if (isset($stat->user->country_acronym) === true)
                                <img
                                    class="flag-country flag-country--scoreboard"
                                    src="/images/flags/{{ $stat->user->country_acronym }}.png"
                                    alt="{{ $stat->user->country_acronym }}"
                                    title="{{ $stat->user->countryName() }}"
                                />
                            @endif    
                        </div>                    
                        <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--player">
                            {{
                                link_to_route(
                                    'users.show',
                                    $stat->user->username,
                                    ['users' => $stat->user->user_id],
                                    []
                                )
                            }}
                        </div>
                        <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--accuracy">
                            {{ number_format($stat->accuracy_new, 2) }}%
                        </div>
                        <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--play-count">
                            {{ number_format($stat->playcount) }}
                        </div>
                        <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--score">
                            {{ number_format($stat->rank_score) }}pp
                        </div>
                        <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--x-count hidden-xs">
                            {{ number_format($stat->x_rank_count) }}
                        </div>
                        <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--s-count hidden-xs">
                            {{ number_format($stat->s_rank_count) }}
                        </div>
                        <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--a-count hidden-xs">
                            {{ number_format($stat->a_rank_count) }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
