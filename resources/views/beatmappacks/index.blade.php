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
@extends("master", [
    'current_section' => 'beatmappacks',
    'current_action' => 'index',
    'title' => trans('beatmappacks.index.title'),
    'pageDescription' => trans('beatmappacks.index.title'),
    'body_additional_classes' => 'osu-layout--body-darker',
])

@section("content")
    <div class="osu-page">
        <div class="osu-page-header-v2">
            <div class="osu-page-header-v2__overlay"></div>
            <div class="osu-page-header-v2__title">{{trans('beatmappacks.title')}}</div>
        </div>
        <ul class="page-mode">
            <li class="page-mode__item"><a href="{{ route('beatmappacks.index', ['t' => 's']) }}">Standard</a>
            <li class="page-mode__item"><a href="{{ route('beatmappacks.index', ['t' => 'r']) }}">Chart</a>
            <li class="page-mode__item"><a href="{{ route('beatmappacks.index', ['t' => 't']) }}">Theme</a>
            <li class="page-mode__item"><a href="{{ route('beatmappacks.index', ['t' => 'a']) }}">Artist/Album</a>
        </ul>
    </div>
    <div class="osu-layout__row">
        <div class="beatmap-packs accordion">
            @foreach ($packs as $pack)
                <div class="js-beatmap-pack beatmap-pack accordion__item" data-pack-id="{{ $pack['pack_id'] }}">
                    <div class="js-beatmap-pack-expander beatmap-packs__row beatmap-pack__header accordion__item-header"
                         data-pack-id="{{ $pack['pack_id'] }}">
                        <span class="beatmap-packs__cell beatmap-pack__name">{{ $pack['name'] }}</span>
                        <span class="beatmap-packs__cell beatmap-pack__date">{{ $pack['date'] }}</span>
                        <span class="beatmap-packs__cell beatmap-pack__author">{{ $pack['author'] }}</span>
                    </div>
                    <div class="js-beatmap-pack__items beatmap-pack__body beatmap-pack__items accordion__item-body"></div>
                </div>
            @endforeach
        </div>
    <div class="osu-layout__row">
@endsection
