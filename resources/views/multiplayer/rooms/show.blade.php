{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Transformers\SelectOptionTransformer;

    $selectOptionTransformer = new SelectOptionTransformer();
    $season = $room->season;
    [$type, $titlePrefix] = $season === null
        ? ['multiplayer', osu_trans('rankings.type.multiplayer')]
        : ['seasons', osu_trans('rankings.type.season_room')];
@endphp
@extends('rankings.index', [
    'hasFilter' => false,
    'hasMode' => false,
    'params' => ['type' => $type],
    'titlePrepend' => $titlePrefix.': '.$room->name,
])

@section('ranking-header')
    <div class="osu-page osu-page--ranking-info">
        @if ($season !== null)
            <span>
                <a
                    class="btn-osu-big btn-osu-big--rounded-thin"
                    href="{{ route('seasons.show', ['season' => $season->getKey()]) }}"
                >
                    {{ osu_trans('rankings.seasons.summary') }}
                </a>
            </span>
        @endif
        @include('objects._basic_select_options', ['selectOptions' => [
            'currentItem' => json_item($room, $selectOptionTransformer),
            'items' => json_collection($rooms, $selectOptionTransformer),
            'type' => 'multiplayer',
        ]])

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
                    {{ i18n_number_format($scores->total()) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scores')
    @include('multiplayer.rooms._rankings_table', compact('scores'))
@endsection

@section('scores-header')
    @if ($room->isRealtime())
        <a
            class="btn-osu-big btn-osu-big--rounded-thin"
            href="{{ route('multiplayer.rooms.events', ['room' => $room->getKey()]) }}"
        >
            {{ osu_trans('multiplayer.room.view_history') }}
        </a>
    @endif
@endsection

@section('ranking-footer')
    @include('rankings._beatmapsets', compact('beatmapsets'))
@endsection
