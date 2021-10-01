{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('rankings.index', ['hasFilter' => false])

@section('ranking-header')
    <div
        class="osu-page osu-page--description js-react--spotlight-select-options"
    ></div>

    <script id="json-spotlight-select-options" type="application/json">
        {!! json_encode($selectOptions) !!}
    </script>

    <div class="osu-page osu-page--info-bar">
        <div class="grid-items">
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.spotlight.start_date') }}
                </div>
                <div class="counter-box__count">
                    {{ $spotlight->start_date->formatLocalized('%Y-%m-%d') }}
                </div>
            </div>
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.spotlight.end_date') }}
                </div>
                <div class="counter-box__count">
                    {{ $spotlight->end_date->formatLocalized('%Y-%m-%d') }}
                </div>
            </div>
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.spotlight.map_count') }}
                </div>
                <div class="counter-box__count">
                    {{ count($beatmapsets) }}
                </div>
            </div>
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.spotlight.participants') }}
                </div>
                <div class="counter-box__count">
                    {{ i18n_number_format($scoreCount) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scores')
    @include('rankings._spotlight_rankings_table', compact('scores'))
@endsection

@section('ranking-footer')
    @include('rankings._beatmapsets', compact('beatmapsets'))
@endsection
