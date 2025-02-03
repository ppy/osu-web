{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('rankings.index', [
    'hasMode' => false,
    'hasPager' => true,
    'type' => 'daily_challenge',
    'titlePrepend' => osu_trans('rankings.type.daily_challenge').': '.$currentRoomOption['text'],
])

@php
    $percentile = $playlist->scorePercentile();
@endphp
@section('ranking-header')
    <div class="osu-page osu-page--ranking-info">
        <div class="js-react--basic-select-options">
            <div class="select-options">
                <div class="select-options__select">
                    <span class="select-options__option">
                        {{ $currentRoomOption['text'] }}
                    </span>
                </div>
            </div>
        </div>

        <script id="json-basic-select-options" type="application/json">
            {!! json_encode([
                'currentItem' => $currentRoomOption,
                'items' => $roomOptions,
                'type' => 'daily_challenge',
            ]) !!}
        </script>

        <div class="grid-items grid-items--ranking-info-bar">
            <div class="counter-box counter-box--ranking">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.daily_challenge.beatmap') }}
                </div>
                <div class="counter-box__count">
                    <span class="fal fa-extra-mode-{{ $playlist->beatmap->mode }}"></span>
                    {{ $playlist->beatmap->version }}
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
            <div class="counter-box counter-box--ranking">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.daily_challenge.top_10p') }}
                </div>
                <div class="counter-box__count">
                    {{ i18n_number_format($percentile['top_10p']) }}
                </div>
            </div>
            <div class="counter-box counter-box--ranking">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.daily_challenge.top_50p') }}
                </div>
                <div class="counter-box__count">
                    {{ i18n_number_format($percentile['top_50p']) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scores-header')
    @include('rankings._beatmapsets', ['beatmapsets' => [$playlist->beatmap->beatmapset], 'modifiers' => 'daily-challenge'])
@endsection

@section('scores')
    @include('multiplayer.rooms._rankings_table')
@endsection
