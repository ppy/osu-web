{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $mode = default_mode();
@endphp
@extends('rankings.index', [
    'country' => null,
    'hasFilter' => false,
    'hasMode' => false,
    'hasPager' => false,
    'hasScores' => false,
    'spotlight' => null,
    'titlePrepend' => osu_trans('rankings.type.seasons').': '.$season->name,
    'type' => 'seasons',
])

@section('ranking-header')
    <div class="osu-page osu-page--description js-react--ranking-select-options">
        <div class="spotlight-select-options">
            <div class="spotlight-select-options__select">
                <span class="spotlight-select-options__option">
                    {{ $season->name }}
                </span>
            </div>
        </div>
    </div>

    @if ($season->hasRooms())
        <div class="osu-page osu-page--info-bar">
            <div class="grid-items">
                <div class="counter-box counter-box--info">
                    <div class="counter-box__title">
                        {{ osu_trans('rankings.spotlight.start_date') }}
                    </div>
                    <div class="counter-box__count">
                        {{ $season->startDate()->formatLocalized('%Y-%m-%d') }}
                    </div>
                </div>

                <div class="counter-box counter-box--info">
                    <div class="counter-box__title">
                        {{ osu_trans('rankings.spotlight.end_date') }}
                    </div>
                    @if ($season->concluded)
                        <div class="counter-box__count">
                            {{ $season->endDate()->formatLocalized('%Y-%m-%d') }}
                        </div>
                    @else
                        <div class="counter-box__count" title="{{ osu_trans('rankings.seasons.ongoing') }}">
                            ---
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="osu-page osu-page--generic">
        <div class="js-react--seasons-show-list"></div>
    </div>

    <script id="json-ranking-select-options" type="application/json">
        {!! json_encode($selectOptions) !!}
    </script>

    <script id="json-rooms" type="application/json">
        {!! json_encode($roomsJson) !!}
    </script>

    <script id="json-season" type="application/json">
        {!! json_encode($selectOptions['currentItem']) !!}
    </script>
@endsection

@include('layout._react_js', ['src' => 'js/seasons-show.js'])
