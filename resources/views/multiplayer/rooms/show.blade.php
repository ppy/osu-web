{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    // used in table and index
    $mode = default_mode();
@endphp
@extends('rankings.index', [
    'country' => null,
    'hasFilter' => false,
    'hasMode' => false,
    'hasPager' => true,
    'spotlight' => null,
    'titlePrepend' => osu_trans('rankings.type.multiplayer').': '.$room->name,
    'type' => 'multiplayer',
])

@section('ranking-header')
    <div class="osu-page osu-page--description js-react--ranking-select-options">
        <div class="select-options select-options--spotlight">
            <div class="select-options__select">
                <span class="select-options__option">
                    {{ $room->name }}
                </span>
            </div>
        </div>
    </div>

    <script id="json-ranking-select-options" type="application/json">
        {!! json_encode([
            'currentItem' => json_item($room, 'Multiplayer\Room'),
            'items' => json_collection($rooms, 'Multiplayer\Room'),
            'type' => 'multiplayer',
        ]) !!}
    </script>

    <div class="osu-page osu-page--info-bar">
        <div class="grid-items">
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.spotlight.start_date') }}
                </div>
                <div class="counter-box__count">
                    {{ $room->starts_at->formatLocalized('%Y-%m-%d') }}
                </div>
            </div>
            @if ($room->ends_at !== null)
                <div class="counter-box counter-box--info">
                    <div class="counter-box__title">
                        {{ osu_trans('rankings.spotlight.end_date') }}
                    </div>
                    <div class="counter-box__count">
                        {{ $room->ends_at->formatLocalized('%Y-%m-%d') }}
                    </div>
                </div>
            @endif
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.spotlight.map_count') }}
                </div>
                <div class="counter-box__count">
                    {{ i18n_number_format(count($beatmaps)) }}
                </div>
            </div>
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.spotlight.participants') }}
                </div>
                <div class="counter-box__count">
                    {{ i18n_number_format($room->participant_count) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scores')
    @include('multiplayer.rooms._rankings_table', compact('scores'))
@endsection

@section('ranking-footer')
    @include('rankings._beatmapsets', compact('beatmapsets'))
@endsection
