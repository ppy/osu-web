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

<div class="osu-page-header osu-page-header--beatmappacks">
    <div class="beatmap-packs-header">
        <div class="beatmap-packs-header__header">
            <div class="beatmap-packs-header__icon"></div>
            <div class="beatmap-packs-header__title">{{trans('beatmappacks.index.title')}}</div>
        </div>
        <div class="beatmap-packs-header__blurb">
            @php
                $scaryTexts = [
                    '<span class="beatmap-packs-header__scary">' . trans('beatmappacks.index.blurb.instruction.scary') . '</span>',
                    '<span class="beatmap-packs-header__scary">' . trans('beatmappacks.index.blurb.note.scary') . '</span>',
                ];
            @endphp
            <p class="beatmap-packs-header__important">{{ trans('beatmappacks.index.blurb.important') }}</p>
            <p>{!! trans('beatmappacks.index.blurb.instruction._', ['scary' => $scaryTexts[0]]) !!}</p>
            <p>{!! trans('beatmappacks.index.blurb.note._', ['scary' => $scaryTexts[1]]) !!}</p>
        </div>
    </div>
</div>
