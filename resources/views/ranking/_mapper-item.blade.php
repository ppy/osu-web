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
<div class="ranking-scoreboard__row ranking-scoreboard__row--score {{ $currentUser && $stat->user_id == $currentUser->user_id ? 'ranking-scoreboard__row--myself' : '' }}">
    <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--rank">
        #{{ $position }}
    </div>
    <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--flag">
        @if (isset($stat->country_acronym) === true)
            <img
                class="flag-country flag-country--scoreboard"
                src="/images/flags/{{ $stat->country_acronym }}.png"
                alt="{{ $stat->country_acronym }}"
                title="{{ $stat->countryName() }}"
            />
        @endif
    </div>
    <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--mapper">
        {{
            link_to_route(
                'users.show',
                $stat->username,
                ['users' => $stat->user_id]
            )
        }}
    </div>
    <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--kudosu-received">
        {{ number_format($stat->kudostotal) }}
    </div>
    <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--kudosu-given hidden-xs">
        {{ number_format($stat->kudostotal - $stat->kudosavailable) }}
    </div>
    <div class="ranking-scoreboard__row-item ranking-scoreboard__row-item--kudosu-available">
        {{ number_format($stat->kudosavailable) }}
    </div>
</div>
