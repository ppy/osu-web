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


<div>
    <ul class="beatmap-pack__downloads">
        @foreach ($pack->downloadUrls() as $download)
            <li class="beatmap-pack__download">
                <a href="{{ $download['url'] }}"
                   class="beatmap-pack__link">Download
                </a> from {{ $download['host'] }}
        @endforeach
    </ul>
</div>
<div class="beatmap-pack-items">
    <div class="beatmap-pack-items__title">
        {{ $pack->name }}
    </div>
    <div class="beatmap-pack-items__author">
        {{ $pack->author }}
    </div>

    <div class="beatmap-pack-items__sets">
        @foreach ($sets as $set)
            <div class="beatmap-pack-items__set">
                {{ $set->title }}
            </div>
        @endforeach
    </div>
</div>
