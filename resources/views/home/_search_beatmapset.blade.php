{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
<div class="search-result search-result--beatmapset">
    <h2 class="search-result__title">
        @lang('home.search.beatmapsets.title')
    </h2>

    <div class="search-result__result">
        @foreach ($result['data'] as $entry)
            <div
                class="js-react--beatmapset-panel search-result__entry"
                data-beatmapset-panel="{{ json_encode(['beatmap' => json_item($entry, 'Beatmapset', ['beatmaps'])]) }}"
            ></div>
        @endforeach
    </div>

    <a
        class="search-result__more"
        href="{{ route('beatmapsets.index', ['q' => $search->params['query']]) }}"
    >
        @lang('home.search.beatmapsets.more_simple')
    </a>
</div>
