{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('rankings.index')

@section('ranking-header')
    <div
        class="js-react--spotlight-select-options"
    ></div>

    <script id="json-spotlight-select-options" type="application/json">
        {!! json_encode($selectOptions) !!}
    </script>

    <div class="spotlight-info">
        <div class="spotlight-info__items">
            <div class="spotlight-info__item">
                <div class="spotlight-info__item-header">
                    {{ trans('rankings.spotlight.start_date') }}
                </div>
                {{ $spotlight->start_date->formatLocalized('%Y-%m-%d') }}
            </div>
            <div class="spotlight-info__item">
                <div class="spotlight-info__item-header">
                    {{ trans('rankings.spotlight.end_date') }}
                </div>
                {{ $spotlight->end_date->formatLocalized('%Y-%m-%d') }}
            </div>
            <div class="spotlight-info__item">
                <div class="spotlight-info__item-header">
                    {{ trans('rankings.spotlight.map_count') }}
                </div>
                {{ count($beatmapsets) }}
            </div>
            <div class="spotlight-info__item">
                <div class="spotlight-info__item-header">
                    {{ trans('rankings.spotlight.participants') }}
                </div>
                {{ i18n_number_format($scoreCount) }}
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
