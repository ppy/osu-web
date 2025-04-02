{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Http\Controllers\RankingController;
@endphp
@extends('rankings.index', ['hasFilter' => false])

@section('scores-header')
    <div class="sort">
        <div class="sort__items">
            <div class="sort__item sort__item--title">
                {{ osu_trans('sort._') }}
            </div>
            @foreach ([['performance', 'performance'], ['score', 'ranked_score']] as $newSort)
                <a
                    class="{{ class_with_modifiers('sort__item', 'button', ['active' => $newSort[0] === $sort]) }}"
                    href="{{ RankingController::url('team', $mode, sort: $newSort[0]) }}"
                >
                    {{ osu_trans("rankings.stat.{$newSort[1]}") }}
                </a>
            @endforeach
        </div>
    </div>
@endsection
@section("scores")
    <table class="ranking-page-table">
        <thead>
            <tr>
                <th class="ranking-page-table__heading"></th>
                <th class="ranking-page-table__heading ranking-page-table__heading--main"></th>
                <th class="ranking-page-table__heading">
                    {{ osu_trans('rankings.stat.members') }}
                </th>
                <th class="ranking-page-table__heading">
                    {{ osu_trans('rankings.stat.play_count') }}
                </th>
                <th class="{{ class_with_modifiers('ranking-page-table__heading', ['focused' => $sort === 'score']) }}">
                    {{ osu_trans('rankings.stat.ranked_score') }}
                </th>
                <th class="ranking-page-table__heading">
                    {{ osu_trans('rankings.stat.average_score') }}
                </th>
                <th class="{{ class_with_modifiers('ranking-page-table__heading', ['focused' => $sort === 'performance']) }}">
                    {{ osu_trans('rankings.stat.performance') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $index => $score)
                <tr class="ranking-page-table__row">
                    <td class="ranking-page-table__column ranking-page-table__column--rank">
                        #{{ $scores->firstItem() + $index }}
                    </td>
                    <td class="ranking-page-table__column">
                        <div class="ranking-page-table__user-link">
                            @php
                                $url = route('teams.leaderboard', [
                                    'ruleset' => $mode,
                                    'team' => $score->team->getKey(),
                                ]);
                            @endphp
                            <div class="ranking-page-table__flags">
                                <a class="u-contents" href="{{ $url }}">
                                    @include('objects._flag_team', ['team' => $score->team])
                                </a>
                            </div>
                            <a class="ranking-page-table__user-link-text u-ellipsis-overflow" href="{{ $url }}">
                                {{ $score->team->name }}
                            </a>
                        </div>
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--value ranking-page-table__column--dimmed">
                        {{ i18n_number_format($score->members_count) }}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--value ranking-page-table__column--dimmed">
                        {{ i18n_number_format($score->play_count) }}
                    </td>
                    <td class="{{ class_with_modifiers('ranking-page-table__column', [
                        'value',
                        $sort === 'score' ? 'focused' : 'dimmed',
                    ]) }}">
                        {{ i18n_number_format($score->ranked_score) }}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--value ranking-page-table__column--dimmed">
                        {{ i18n_number_format(round($score->ranked_score / max($score->members_count, 1))) }}
                    </td>
                    <td class="{{ class_with_modifiers('ranking-page-table__column', [
                        'value',
                        $sort === 'performance' ? 'focused' : 'dimmed',
                    ]) }}">
                        {{ i18n_number_format(round($score->performance)) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
