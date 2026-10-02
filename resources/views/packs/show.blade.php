{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => $pack->name])

@section('content')
    @include('packs._header')

    <div class="osu-page">
        <div class="beatmap-packs">
            <div class="beatmap-pack beatmap-pack--expanded">
                <a href="{{ route('packs.show', $pack) }}" class="beatmap-pack__header">
                    @include('packs._item_header', ['pack' => $pack])
                </a>

                <div class="beatmap-pack__body">
                    @include('packs.raw', compact('pack', 'sets', 'mode'))
                </div>
            </div>
        </div>
    </div>
@endsection
