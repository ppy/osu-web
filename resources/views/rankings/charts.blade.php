{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('rankings.index')

@section('ranking-header')
    <div class="osu-page osu-page--ranking-info">
        <div class="js-react--spotlight-select-options">
            <div class="select-options select-options--spotlight">
                <div class="select-options__select">
                    <span class="select-options__option">
                        {{ $spotlight->name }}
                    </span>
                </div>
            </div>
        </div>

        <script id="json-spotlight-select-options" type="application/json">
            {!! json_encode($selectOptions) !!}
        </script>

        <div class="grid-items grid-items--ranking-info-bar">
            <div class="counter-box counter-box--ranking">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.spotlight.start_date') }}
                </div>
                <div class="counter-box__count">
                    {{ json_date($spotlight->start_date) }}
                </div>
            </div>
            <div class="counter-box counter-box--ranking">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.spotlight.end_date') }}
                </div>
                <div class="counter-box__count">
                    {{ json_date($spotlight->end_date) }}
                </div>
            </div>
            <div class="counter-box counter-box--ranking">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.spotlight.map_count') }}
                </div>
                <div class="counter-box__count">
                    {{ count($beatmapsets) }}
                </div>
            </div>
            <div class="counter-box counter-box--ranking">
                <div class="counter-box__title">
                    {{ osu_trans('rankings.spotlight.participants') }}
                </div>
                <div class="counter-box__count">
                    {{ i18n_number_format($scoreCount) }}
                </div>
            </div>

            <div class="grid-items__item grid-items__item--spotlight-user-filter">
                @include('rankings._user_filter')
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
