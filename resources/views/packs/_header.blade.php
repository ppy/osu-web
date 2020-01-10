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
@php
    $links = [
        [
            'title' => trans('beatmappacks.index.nav_title'),
            'url' => route('packs.index'),
        ],
    ];

    if (isset($pack)) {
        $links[] = [
            'title' => $pack->name,
            'url' => route('packs.show', $pack),
        ];
    }
@endphp

@include('layout._page_header_v4', ['params' => [
    'links' => $links,
    'linksBreadcrumb' => true,
    'section' => trans('layout.header.beatmapsets._'),
    'subSection' => trans('layout.header.beatmapsets.packs'),
    'theme' => 'beatmappacks',
]])

<div class="osu-page">
    <div class="beatmap-packs-header">
        @php
            $scaryTexts = [
                tag('span', ['class' => 'beatmap-packs-header__scary'], trans('beatmappacks.index.blurb.instruction.scary')),
                tag('span', ['class' => 'beatmap-packs-header__scary'], trans('beatmappacks.index.blurb.note.scary')),
            ];
        @endphp
        <p class="beatmap-packs-header__important">{{ trans('beatmappacks.index.blurb.important') }}</p>
        <p>{!! trans('beatmappacks.index.blurb.instruction._', ['scary' => $scaryTexts[0]]) !!}</p>
        <p>{!! trans('beatmappacks.index.blurb.note._', ['scary' => $scaryTexts[1]]) !!}</p>
    </div>
</div>
