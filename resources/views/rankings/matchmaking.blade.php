{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Http\Controllers\Ranking\MatchmakingController;

    $params = ['mode' => $rulesetName];
@endphp
@extends('rankings.index', [
    'hasPager' => $scores !== null,
    'params' => [...$params, 'type' => 'matchmaking'],
    'rulesetSelectorUrlFn' => fn (string $r): string => route('rankings.matchmaking', [...$params, 'mode' => $r]),
    'titlePrepend' => osu_trans('rankings.type.matchmaking').': '.$pool->getDisplayName(),
])

@if (count($pools) > 1)
    @section('ranking-header')
        <div class="osu-page osu-page--ranking-info">
            @include('objects._basic_select_options', ['selectOptions' => [
                ...json_options($pool, $pools, fn ($pool) => [
                    'id' => $pool->getKey(),
                    'text' => $pool->getDisplayName(),
                ]),
                'ruleset' => $rulesetName,
                'type' => 'matchmaking',
            ]])
        </div>
    @endsection
@endif

@section('scores')
    <div class="ranking-page-grid ranking-page-grid--matchmaking">
        <div class="ranking-page-grid-item ranking-page-grid-item--header">
            <div class="ranking-page-grid-item__content">
                <div class="ranking-page-grid-item__col">
                </div>
                <div class="ranking-page-grid-item__col">
                </div>
                <div class="ranking-page-grid-item__col">
                    {{ osu_trans('rankings.matchmaking.wins') }}
                </div>
                <div class="ranking-page-grid-item__col">
                    {{ osu_trans('rankings.matchmaking.plays') }}
                </div>
                <div class="ranking-page-grid-item__col ranking-page-grid-item__col--number-focus">
                    {{ osu_trans('rankings.matchmaking.rating') }}
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
                    <div class="ranking-page-grid-item__col ranking-page-grid-item__col--main">
                        @include('rankings._main_column', ['object' => $score->user])
                    </div>
                    <div class="ranking-page-grid-item__col ranking-page-grid-item__col--number">
                        {{ i18n_number_format($score->first_placements) }}
                    </div>
                    <div class="ranking-page-grid-item__col ranking-page-grid-item__col--number">
                        {{ i18n_number_format($score->elo_data['contest_count']) }}
                    </div>
                    <div class="ranking-page-grid-item__col ranking-page-grid-item__col--number-focus">
                        @php
                            [$provisionalTitle, $provisionalSign] = $score->isRatingProvisional()
                                ? [osu_trans('rankings.matchmaking.provisional'), '*']
                                : ['', ''];
                        @endphp
                        <span title="{{ $provisionalTitle }}">
                            {{ i18n_number_format($score->rating).$provisionalSign }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
