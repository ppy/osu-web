{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'currentAction' => 'packs',
    'title' => $pack->name.' · '.trans('beatmappacks.index.title'),
])

@section('content')
    <div class="osu-page">
        @include('packs._header')

        <div class="beatmap-packs">
            <div class="beatmap-pack beatmap-pack--expanded">
                <a href="{{ route('packs.show', $pack) }}" class="beatmap-pack__header">
                    <div class="beatmap-pack__name">{{ $pack->name }}</div>
                    <div class="beatmap-pack__details">
                        <span class="beatmap-pack__date">{{ $pack->date->formatLocalized('%Y-%m-%d') }}</span>
                        <span class="beatmap-pack__author">by </span>
                        <span class="beatmap-pack__author beatmap-pack__author--bold">{{ $pack->author }}</span>
                    </div>
                </a>

                <div class="beatmap-pack__body">
                    @include('packs.raw', compact('pack', 'sets', 'mode'))
                </div>
            </div>

            <div class="beatmap-packs__footer-links">
                <a href="{{ route('packs.index') }}" class="btn-osu-big btn-osu-big--rounded">
                    {{ trans('beatmappacks.show.back') }}
                </a>
            </div>
        </div>
    </div>
@endsection
