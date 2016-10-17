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
<div class="ranking-scoreboard__tabs">
    @foreach (['osu', 'taiko', 'mania', 'fruits'] as $mode)
        {{
            link_to_route(
                "ranking-$type",
                trans("beatmaps.mode.$mode"),
                $type == 'overall' ?
                [
                    'country' => $currentCountry,
                    'mode' => $mode,
                ] :
                [
                    'mode' => $mode
                ]
                ,
                ['class' => 'ranking-scoreboard__tab' . ($mode === $currentMode ? ' ranking-scoreboard__tab--active' : '')]
            )
        }}
    @endforeach
</div>
<div class="ranking-scoreboard__line">
</div>
