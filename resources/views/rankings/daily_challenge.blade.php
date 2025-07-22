{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $currentId = $dateHelper::makeId($date);
@endphp
@extends('rankings.index', [
    'hasMode' => false,
    'hasPager' => $room !== null,
    'params' => ['type' => 'daily_challenge'],
    'titlePrepend' => osu_trans('rankings.type.daily_challenge').': '.$currentId,
])

@section('ranking-header')
    <div class="osu-page osu-page--ranking-info">
        <div class="daily-challenge-date">
            <div class="daily-challenge-date__header">
                @if (($firstId = $dateHelper->firstId()) === $currentId)
                    <span class="daily-challenge-date__header-arrow daily-challenge-date__header-arrow--disabled">
                        <span class="fas fa-angle-double-left"></span>
                    </span>
                @else
                    <a
                        class="daily-challenge-date__header-arrow"
                        href="{{ route('daily-challenge.show', ['daily_challenge' => $firstId]) }}"
                    >
                        <span class="fas fa-angle-double-left"></span>
                    </a>
                @endif
                @if (($prevMonthId = $dateHelper->prevMonthId()) !== null)
                    <a
                        class="daily-challenge-date__header-arrow"
                        href="{{ route('daily-challenge.show', ['daily_challenge' => $prevMonthId]) }}"
                    >
                        <span class="fas fa-angle-left"></span>
                    </a>
                @else
                    <span class="daily-challenge-date__header-arrow daily-challenge-date__header-arrow--disabled">
                        <span class="fas fa-angle-left"></span>
                    </span>
                @endif
                @include('objects._basic_select_options', ['selectOptions' => [
                    'currentItem' => $dateHelper::makeOption($date, 'year'),
                    'items' => $dateHelper->options('year'),
                    'type' => 'daily_challenge',
                ]])

                @include('objects._basic_select_options', ['selectOptions' => [
                    'currentItem' => $dateHelper::makeOption($date, 'month'),
                    'items' => $dateHelper->options('month'),
                    'type' => 'daily_challenge',
                ]])
                @if (($nextMonthId = $dateHelper->nextMonthId()) !== null)
                    <a
                        class="daily-challenge-date__header-arrow"
                        href="{{ route('daily-challenge.show', ['daily_challenge' => $nextMonthId]) }}"
                    >
                        <span class="fas fa-angle-right"></span>
                    </a>
                @else
                    <span class="daily-challenge-date__header-arrow daily-challenge-date__header-arrow--disabled">
                        <span class="fas fa-angle-right"></span>
                    </span>
                @endif
                @if (($lastId = $dateHelper->lastId()) === $currentId)
                    <span class="daily-challenge-date__header-arrow daily-challenge-date__header-arrow--disabled">
                        <span class="fas fa-angle-double-right"></span>
                    </span>
                @else
                    <a
                        class="daily-challenge-date__header-arrow"
                        href="{{ route('daily-challenge.show', ['daily_challenge' => $lastId]) }}"
                    >
                        <span class="fas fa-angle-double-right"></span>
                    </a>
                @endif
            </div>
            <div class="daily-challenge-date__days">
                @foreach ($dateHelper->days() as $day)
                    @php
                        $option = $dateHelper::makeOption($day, 'day');
                    @endphp
                    <a
                        class="{{ class_with_modifiers('daily-challenge-day', [
                            'active' => $day->equalTo($date),
                            'completed' => isset($userScores[$option['id']]),
                            'extra' => !$dateHelper->isCurrentMonth($day),
                        ]) }}"
                        href="{{ route('daily-challenge.show', ['daily_challenge' => $option['id']]) }}"
                    >
                        <div class="daily-challenge-day__day">
                            {{ $option['text'] }}
                        </div>
                        <div class="daily-challenge-day__completed">
                            <span class="fa fa-check"></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        @if ($room !== null)
            @php
                $percentile = $playlist->scorePercentile();
            @endphp
            <div class="grid-items grid-items--ranking-info-bar">
                <div class="counter-box counter-box--ranking">
                    <div class="counter-box__title">
                        {{ osu_trans('rankings.daily_challenge.beatmap') }}
                    </div>
                    <div class="counter-box__count">
                        <span class="fal fa-extra-mode-{{ $playlist->beatmap->mode }}"></span>
                        {{ $playlist->beatmap->version }}
                    </div>
                </div>
                <div class="counter-box counter-box--ranking">
                    <div class="counter-box__title">
                        {{ osu_trans('rankings.spotlight.participants') }}
                    </div>
                    <div class="counter-box__count">
                        {{ i18n_number_format($scores->total()) }}
                    </div>
                </div>
                <div class="counter-box counter-box--ranking">
                    <div class="counter-box__title">
                        {{ osu_trans('rankings.daily_challenge.top_10p') }}
                    </div>
                    <div class="counter-box__count">
                        {{ i18n_number_format($percentile['top_10p']) }}
                    </div>
                </div>
                <div class="counter-box counter-box--ranking">
                    <div class="counter-box__title">
                        {{ osu_trans('rankings.daily_challenge.top_50p') }}
                    </div>
                    <div class="counter-box__count">
                        {{ i18n_number_format($percentile['top_50p']) }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@if ($room === null)
    @section('scores')
        {{ osu_trans('rankings.daily_challenge.unavailable.'.($date->isPast() ? 'past' : 'future')) }}
    @endsection
@else
    @section('scores-header')
        @include('rankings._beatmapsets', ['beatmapsets' => [$playlist->beatmap->beatmapset], 'modifiers' => 'daily-challenge'])
    @endsection
    @section('scores')
        <table class="ranking-page-table">
            <thead>
                <tr>
                    <th></th>
                    <th class="ranking-page-table__heading ranking-page-table__heading--main"></th>
                    <th class="ranking-page-table__heading">
                        {{ osu_trans('beatmapsets.show.scoreboard.headers.combo') }}
                    </th>
                    <th class="ranking-page-table__heading">
                        {{ osu_trans('rankings.stat.accuracy') }}
                    </th>
                    <th class="ranking-page-table__heading">
                        {{ osu_trans('rankings.stat.play_count') }}
                    </th>
                    <th class="ranking-page-table__heading ranking-page-table__heading--focused">
                        {{ osu_trans('rankings.stat.total_score') }}
                    </th>
                    <th class="ranking-page-table__heading">
                        {{ osu_trans('beatmapsets.show.scoreboard.headers.rank') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    // -1 due to userScore being prepended
                    $firstItem = $scores->firstItem() - 1;
                @endphp
                @foreach ([$userScore, ...$scores] as $index => $agg)
                    @if ($agg === null)
                        @continue
                    @endif
                    @php
                        $score = $agg->score;
                    @endphp
                    @if ($score === null)
                        @continue
                    @endif
                    <tr class="{{ class_with_modifiers('ranking-page-table__row', ['inactive' => !$score->user->isActive()]) }}">
                        <td class="ranking-page-table__column">
                            #{{ i18n_number_format($loop->first
                                ? $agg->userRank()
                                : $firstItem + $index
                            ) }}
                        </td>
                        <td class="ranking-page-table__column ranking-page-table__column--main">
                            @include('rankings._main_column', ['object' => $score->user])
                        </td>
                        <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                            <span class="{{ class_with_modifiers(
                                'ranking-page-table__combo',
                                ['perfect' => $score->is_perfect_combo],
                            ) }}">
                                {{ i18n_number_format($score->max_combo) }}
                            </span>
                        </td>
                        <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                            {{ format_percentage($score->accuracy) }}
                        </td>
                        <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                            {{ i18n_number_format($agg->attempts) }}
                        </td>
                        <td class="ranking-page-table__column">
                            {!! i18n_number_format($score->total_score) !!}
                        </td>
                        <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                            <div class="score-rank score-rank--daily-challenge score-rank--{{ $score->rank }}"></div>
                        </td>
                    </tr>
                    @if ($loop->first)
                        <tr>
                            <td colspan="7">&nbsp;</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endsection
@endif
