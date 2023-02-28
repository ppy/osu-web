{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'pageDescription' => osu_trans('beatmappacks.index.description'),
])

@section('content')
    @include('packs._header')

    <div class="osu-page">
        <ul class="page-mode">
            @foreach(['standard', 'chart', 'theme', 'artist'] as $mode)
                <li class="page-mode__item">
                    @include('packs._type', ['current' => $type, 'type' => $mode, 'title' => osu_trans("beatmappacks.mode.{$mode}")])
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
