{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<table class="ranking-page-table">
    <thead>
        <tr>
            <th></th>
            <th class="ranking-page-table__heading ranking-page-table__heading--main"></th>
            <th class="ranking-page-table__heading">
                {{ osu_trans('rankings.stat.accuracy') }}
            </th>
            <th class="ranking-page-table__heading">
                {{ osu_trans('rankings.stat.play_count') }}
            </th>
            <th class="ranking-page-table__heading ranking-page-table__heading--focused">
                {{ osu_trans('rankings.stat.total_score') }}
            </th>
        </tr>
    </thead>
    <tbody>
        @php
            // -1 due to userScore being prepended
            $firstItem = $scores->firstItem() - 1;
        @endphp
        @foreach ([$userScore, ...$scores] as $index => $score)
            @if ($score === null)
                @continue
            @endif
            <tr class="{{ class_with_modifiers('ranking-page-table__row', ['inactive' => !$score->user->isActive()]) }}">
                <td class="ranking-page-table__column">
                    #{{ i18n_number_format($loop->first
                        ? $score->userRank()
                        : $firstItem + $index
                    ) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--main">
                    @include('rankings._main_column', ['object' => $score->user])
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ format_percentage($score->averageAccuracy()) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ i18n_number_format($score->attempts) }}
                </td>
                <td class="ranking-page-table__column">
                    {!! i18n_number_format($score->total_score) !!}
                </td>
            </tr>
            @if ($loop->first)
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
