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
            <th class="ranking-page-table__heading">
                {{ osu_trans('rankings.stat.total_score') }}
            </th>
            <th class="ranking-page-table__heading ranking-page-table__heading--focused">
                {{ osu_trans('rankings.stat.ranked_score') }}
            </th>
            <th class="ranking-page-table__heading ranking-page-table__heading--grade">
                {{ osu_trans('rankings.stat.ss') }}
            </th>
            <th class="ranking-page-table__heading ranking-page-table__heading--grade">
                {{ osu_trans('rankings.stat.s') }}
            </th>
            <th class="ranking-page-table__heading ranking-page-table__heading--grade">
                {{ osu_trans('rankings.stat.a') }}
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($scores as $index => $score)
            <tr class="{{ class_with_modifiers('ranking-page-table__row', ['inactive' => !$score->user->isActive()]) }}">
                <td class="ranking-page-table__column">
                    #{{ i18n_number_format($index + 1) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--main">
                    @include('rankings._main_column', ['object' => $score->user])
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ format_percentage($score->hit_accuracy / 100) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ i18n_number_format($score->playcount) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {!! suffixed_number_format_tag($score->total_score) !!}
                </td>
                <td class="ranking-page-table__column">
                    {!! suffixed_number_format_tag($score->ranked_score) !!}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ i18n_number_format(max(0, $score->x_rank_count + $score->xh_rank_count)) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ i18n_number_format(max(0, $score->s_rank_count + $score->sh_rank_count)) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ i18n_number_format(max(0, $score->a_rank_count)) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
