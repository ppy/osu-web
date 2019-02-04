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

<div class="rankings-beatmapsets">
    <div class="osu-layout__col-container osu-layout__col-container--with-gutter">
        @foreach ($beatmapsets as $beatmapset)
            <div class="osu-layout__col osu-layout__col--sm-6">
                <div
                    class="js-react--beatmapset-panel"
                    data-beatmapset-panel="{{ json_encode(['beatmap' => json_item($beatmapset, 'Beatmapset', ['beatmaps'])]) }}"
                ></div>
            </div>
        @endforeach
    </div>
</div>
