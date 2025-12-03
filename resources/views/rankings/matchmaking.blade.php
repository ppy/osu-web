{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Http\Controllers\Ranking\MatchmakingController;

    $params = [
        'mode' => $rulesetName,
        'sort' => $sort,
    ];
@endphp
@extends('rankings.index', [
    'hasPager' => $scores !== null,
    'params' => [...$params, 'type' => 'matchmaking'],
    'rulesetSelectorUrlFn' => fn (string $r): string => route('rankings.matchmaking', [...$params, 'mode' => $r]),
    'titlePrepend' => osu_trans('rankings.type.top_plays'),
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

@section('scores-header')
    <div class="sort">
        <div class="sort__items">
            <div class="sort__item sort__item--title">
                {{ osu_trans('sort._') }}
            </div>
            @foreach (MatchmakingController::SORTS as $newSort => $_dbColumns)
                <a
                    class="{{ class_with_modifiers('sort__item', 'button', ['active' => $newSort === $params['sort']]) }}"
                    href="{{ route('rankings.matchmaking', [...$params, 'pool' => $pool->getKey(), 'sort' => $newSort]) }}"
                >
                    {{ osu_trans("rankings.matchmaking.{$newSort}") }}
                </a>
            @endforeach
        </div>
    </div>
@endsection

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
                <div class="{{ class_with_modifiers('ranking-page-grid-item__col', ['number-focus' => $sort === 'points']) }}">
                    {{ osu_trans('rankings.matchmaking.points') }}
                </div>
                <div class="{{ class_with_modifiers('ranking-page-grid-item__col', ['number-focus' => $sort === 'rating']) }}">
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
                    <div class="{{ class_with_modifiers(
                        'ranking-page-grid-item__col',
                        $sort === 'points' ? 'number-focus' : 'number',
                    ) }}">
                        {{ i18n_number_format($score->total_points) }}
                    </div>
                    <div class="{{ class_with_modifiers(
                        'ranking-page-grid-item__col',
                        $sort === 'rating' ? 'number-focus' : 'number',
                    ) }}">
                        {{ i18n_number_format($score->rating) }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
