{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('rankings.index', [
    'hasPager' => $scores !== null,
    'params' => ['mode' => $rulesetName, 'type' => 'top_plays'],
    'rulesetSelectorUrlFn' => fn (string $r): string => route('rankings.top-plays', ['mode' => $r]),
    'titlePrepend' => osu_trans('rankings.type.top_plays'),
])

@if ($scores === null)
    @section('scores')
        {{ osu_trans('rankings.top_plays.empty') }}
    @endsection
@else
    @section('ranking-header')
        <div class="osu-page osu-page--ranking-info">
            <div class="grid-items grid-items--ranking-filter">
                @include('rankings._country_filter', ['params' => ['mode' => $rulesetName]])
            </div>
        </div>
    @endsection
    @section('scores-header')
        <p>
            <small>{{ osu_trans('rankings.top_plays.last_updated') }}: {!! timeago($lastUpdate) !!}</small>
        </p>
    @endsection
    @section('scores')
        <div
            class="u-contents js-react"
            data-props="{{ json_encode([
                'first_score_rank' => $scores->firstItem(),
                'mode' => $rulesetName,
                'scores' => $scoresJson,
            ]) }}"
            data-react="ranking-top-plays"
        >
            <div class="ranking-page-grid">
                <div class="ranking-page-grid-item ranking-page-grid-item--header">
                    <div class="ranking-page-grid-item__content">
                        <div class="ranking-page-grid-item__col">
                            &nbsp;
                        </div>
                    </div>
                </div>
                @foreach ($scores as $score)
                    <div class="ranking-page-grid-item">
                        <div class="ranking-page-grid-item__content">
                            <div class="ranking-page-grid-item__col">
                                <div class="ranking-page-grid-item__icons"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @include('layout._react_js', ['src' => 'js/ranking-top-plays.js'])
    @endsection
@endif
