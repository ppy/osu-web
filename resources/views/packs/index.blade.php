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
@extends('master', [
    'currentAction' => 'packs',
    'title' => trans('beatmappacks.index.title'),
    'pageDescription' => trans('beatmappacks.index.description'),
])

@section('content')
    @include('packs._header')

    <div class="osu-page">
        <ul class="page-mode">
            @foreach(['standard', 'chart', 'theme', 'artist'] as $mode)
                <li class="page-mode__item">
                    @include('packs._type', ['current' => $type, 'type' => $mode, 'title' => trans("beatmappacks.mode.{$mode}")])
            @endforeach
        </ul>

        <div class="beatmap-packs js-accordion">
            @foreach ($packs as $pack)
                <div class="beatmap-pack js-beatmap-pack js-accordion__item" data-pack-id="{{ $pack->getKey() }}">
                    <a href="{{ route('packs.show', $pack) }}" class="beatmap-pack__header js-accordion__item-header">
                        <div class="beatmap-pack__name">{{ $pack->name }}</div>
                        <div class="beatmap-pack__details">
                            <span class="beatmap-pack__date">{{ $pack->date->formatLocalized('%Y-%m-%d') }}</span>
                            <span class="beatmap-pack__author">by </span>
                            <span class="beatmap-pack__author beatmap-pack__author--bold">{{ $pack->author }}</span>
                        </div>
                    </a>
                    <div class="beatmap-pack__body js-accordion__item-body"></div>
                </div>
            @endforeach

            <div class="beatmap-packs__pager">
                @include('objects._pagination_v2', ['object' => $packs])
            </div>
        </div>
    </div>
@endsection
