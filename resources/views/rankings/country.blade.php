{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('rankings.index', ['hasFilter' => false])

@section("scores")
    <table class="ranking-page-table">
        <thead>
            <tr>
                <th></th>
                <th class="ranking-page-table__heading ranking-page-table__heading--main"></th>
                <th class="ranking-page-table__heading">
                    {{ osu_trans('rankings.stat.active_users') }}
                </th>
                <th class="ranking-page-table__heading">
                    {{ osu_trans('rankings.stat.play_count') }}
                </th>
                <th class="ranking-page-table__heading">
                    {{ osu_trans('rankings.stat.ranked_score') }}
                </th>
                <th class="ranking-page-table__heading">
                    {{ osu_trans('rankings.stat.average_score') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--focused">
                    {{ osu_trans('rankings.stat.performance') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $firstItem = $scores->firstItem();
            @endphp
            @foreach ($scores as $index => $score)
                <tr class="ranking-page-table__row">
                    <td class="ranking-page-table__column">
                        #{{ i18n_number_format($firstItem + $index) }}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--main">
                        @include('rankings._main_column', ['object' => $score->country])
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                        {{ i18n_number_format($score->user_count) }}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                        {!! suffixed_number_format_tag($score->play_count) !!}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                        {!! suffixed_number_format_tag($score->ranked_score) !!}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                        {!! suffixed_number_format_tag(round($score->ranked_score / max($score->user_count, 1))) !!}
                    </td>
                    <td class="ranking-page-table__column">
                        {!! suffixed_number_format_tag(round($score->performance)) !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
