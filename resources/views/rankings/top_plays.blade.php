{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('rankings.index', [
    'currentRoute' => 'rankings.top-plays',
    'hasPager' => $scores !== null,
    'params' => ['mode' => $rulesetName, 'type' => 'top_plays'],
    'titlePrepend' => osu_trans('rankings.type.top_plays'),
])

@if ($scores === null)
    @section('scores')
        {{ osu_trans('rankings.top_plays.empty') }}
    @endsection
@else
    @section('scores')
        <div
            class="u-contents js-react--ranking-top-plays"
            data-props="{{ json_encode([
                'first_score_rank' => $scores->firstItem(),
                'scores' => $scoresJson,
            ]) }}"
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
