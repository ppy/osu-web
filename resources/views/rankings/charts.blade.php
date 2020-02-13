{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends('rankings.index')

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
                    {{ trans('rankings.spotlight.start_date') }}
                </div>
                <div class="counter-box__count">
                    {{ $spotlight->start_date->formatLocalized('%Y-%m-%d') }}
                </div>
            </div>
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ trans('rankings.spotlight.end_date') }}
                </div>
                <div class="counter-box__count">
                    {{ $spotlight->end_date->formatLocalized('%Y-%m-%d') }}
                </div>
            </div>
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ trans('rankings.spotlight.map_count') }}
                </div>
                <div class="counter-box__count">
                    {{ count($beatmapsets) }}
                </div>
            </div>
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ trans('rankings.spotlight.participants') }}
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
