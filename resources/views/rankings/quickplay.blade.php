{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('rankings.index', [
    'currentRoute' => 'rankings.quickplay',
    'hasPager' => $scores !== null,
    'params' => ['mode' => $rulesetName, 'type' => 'quickplay'],
    'titlePrepend' => osu_trans('rankings.type.top_plays'),
])

@section('scores')
    <div class="ranking-page-grid ranking-page-grid--quickplay">
        <div class="ranking-page-grid-item ranking-page-grid-item--header">
            <div class="ranking-page-grid-item__content">
                <div class="ranking-page-grid-item__col">
                </div>
                <div class="ranking-page-grid-item__col">
                </div>
                <div class="ranking-page-grid-item__col">
                    {{ osu_trans('rankings.quickplay.wins') }}
                </div>
                <div class="ranking-page-grid-item__col">
                    {{ osu_trans('rankings.quickplay.plays') }}
                </div>
                <div class="ranking-page-grid-item__col">
                    {{ osu_trans('rankings.quickplay.points') }}
                </div>
                <div class="ranking-page-grid-item__col ranking-page-grid-item__col--number-focus">
                    {{ osu_trans('rankings.quickplay.rating') }}
                </div>
            </div>
        </div>
        @php
            $firstItem = $scores->firstItem();
        @endphp
        @foreach ($scores as $index => $score)
            <div class="ranking-page-grid-item">
                <div class="ranking-page-grid-item__content u-hover">
                    <div class="ranking-page-grid-item__col">
                        #{{ i18n_number_format($index + $firstItem) }}
                    </div>
                    <div class="ranking-page-grid-item__col">
                        @include('rankings._main_column', ['object' => $score->user])
                    </div>
                    <div class="ranking-page-grid-item__col ranking-page-grid-item__col--number">
                        {{ i18n_number_format($score->first_placements) }}
                    </div>
                    <div class="ranking-page-grid-item__col ranking-page-grid-item__col--number">
                        {{ i18n_number_format($score->elo_data['contest_count']) }}
                    </div>
                    <div class="ranking-page-grid-item__col ranking-page-grid-item__col--number">
                        {{ i18n_number_format($score->total_points) }}
                    </div>
                    <div class="ranking-page-grid-item__col ranking-page-grid-item__col--number-focus">
                        {{ i18n_number_format($score->rating) }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
