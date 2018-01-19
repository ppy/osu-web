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
    'current_action' => 'packs',
    'title' => trans('beatmappacks.index.title'),
    'pageDescription' => trans('beatmappacks.index.description'),
    'body_additional_classes' => 'osu-layout--body-555',
])

@section("content")
    <div class="beatmap-packs">
        <div class="osu-page">
            <div class="osu-page-header osu-page-header--beatmappacks">
                <div class="beatmap-packs__page-header">
                    <div class="beatmap-packs__page-icon osu-page-header__icon--beatmappacks"></div>
                    <div class="beatmap-packs__page-title">{{trans('beatmappacks.index.title')}}</div>
                </div>
                <div class="beatmap-packs__blurb">
                    @php
                        $scaryTexts = [
                            '<span class="beatmap-packs__scary">' . trans('beatmappacks.index.blurb.instruction.scary') . '</span>',
                            '<span class="beatmap-packs__scary">' . trans('beatmappacks.index.blurb.note.scary') . '</span>',
                        ];
                    @endphp
                    <p class="beatmap-packs__important">@lang('beatmappacks.index.blurb.important')</p>
                    <p>@lang('beatmappacks.index.blurb.instruction._', ['scary' => $scaryTexts[0]])</p>
                    <p>@lang('beatmappacks.index.blurb.note._', ['scary' => $scaryTexts[1]])</p>
                </div>
            </div>
            <ul class="page-mode">
                @foreach(['standard', 'chart', 'theme', 'artist'] as $mode)
                    <li class="page-mode__item">
                        @include('packs._type', ['current' => $type, 'type' => $mode, 'title' => trans("beatmappacks.mode.{$mode}")])
                @endforeach
            </ul>
        </div>
        <div class="osu-layout__row">
            <div class="beatmap-packs__list js-accordion">
                @foreach ($packs as $pack)
                    <div class="beatmap-pack js-beatmap-pack js-accordion__item" data-pack-id="{{ $pack['pack_id'] }}">
                        <div class="beatmap-packs__row beatmap-pack__header js-accordion__item-header">
                            <div class="beatmap-packs__cell beatmap-pack__name">{{ $pack['name'] }}</div>
                            <div class="beatmap-packs__cell beatmap-packs__cell--right">
                                <span class="beatmap-pack__date">{{ $pack['date']->formatLocalized('%Y-%m-%d') }}</span>
                                <span class="beatmap-pack__author">by </span>
                                <span class="beatmap-pack__author beatmap-pack__author--bold">{{ $pack['author'] }}</span>
                            </div>
                        </div>
                        <div class="beatmap-pack__body js-accordion__item-body"></div>
                    </div>
                @endforeach

                <div class="beatmap-packs__pager">
                    @include('objects._pagination', ['object' => $packs])
                </div>
            </div>
        </div>
    </div>
@endsection
