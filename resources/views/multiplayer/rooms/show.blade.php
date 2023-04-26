{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Transformers\SelectOptionTransformer;

    $selectOptionTransformer = new SelectOptionTransformer();
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
    <div class="osu-page osu-page--ranking-info">
        <div class="js-react--ranking-select-options">
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
                'currentItem' => json_item($room, $selectOptionTransformer),
                'items' => json_collection($rooms, $selectOptionTransformer),
                'type' => 'multiplayer',
            ]) !!}
        </script>

        <div class="grid-items grid-items--ranking-info-bar">
            <div class="counter-box counter-box--ranking">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.spotlight.start_date') }}
                </div>
                <div class="counter-box__count">
                    {{ json_date($room->starts_at) }}
                </div>
            </div>
            @if ($room->ends_at !== null)
                <div class="counter-box counter-box--ranking">
                    <div class="counter-box__title">
                        {{ osu_trans('rankings.spotlight.end_date') }}
                    </div>
                    <div class="counter-box__count">
                        {{ json_date($room->ends_at) }}
                    </div>
                </div>
            @endif
            <div class="counter-box counter-box--ranking">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.spotlight.map_count') }}
                </div>
                <div class="counter-box__count">
                    {{ i18n_number_format(count($beatmaps)) }}
                </div>
            </div>
            <div class="counter-box counter-box--ranking">
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
