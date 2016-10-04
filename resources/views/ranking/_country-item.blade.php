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
<div class="ranking-scoreboard__row ranking-scoreboard__row--score">
    <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--rank">
        #{{ $position }}
    </div>
    <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--flag">
        <img
            class="flag-country flag-country--scoreboard"
            src="/images/flags/{{ $stat->acronym }}.png"
            alt="{{ $stat->acronym }}"
            title="{{ $stat->name }}"
        />    
    </div> 
    <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--country">
        {{
            link_to_route(
                'ranking-overall',
                $stat->name,
                ['country' => $stat->acronym]
            )
        }}
    </div>
    <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--user-count hidden-xs">
        {{ number_format($stat->usercount) }}
    </div>
    <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--play-count hidden-xs">
        {{ number_format($stat->playcount) }}
    </div>
    <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--country-score">
        {{ number_format($stat->rankedscore) }}
    </div>
    <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--country-performance">
        {{ number_format($stat->pp) }}pp
    </div>
</div>
