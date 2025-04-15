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
            <th class="{{ class_with_modifiers('ranking-page-table__heading', ['focused' => $sort === 'score']) }}">
                {{ osu_trans('rankings.stat.ranked_score') }}
            </th>
            <th class="{{ class_with_modifiers('ranking-page-table__heading', ['focused' => $sort === 'performance']) }}">
                {{ osu_trans('rankings.stat.performance') }}
            </th>
            <th class="ranking-page-table__heading">
                {{ osu_trans('teams.leaderboard.global_rank') }}
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
        @foreach ($leaderboard as $i => $stats)
            <tr class="{{ class_with_modifiers('ranking-page-table__row', ['inactive' => !$stats->user->isActive()]) }}">
                <td class="ranking-page-table__column">
                    #{{ i18n_number_format($i + 1) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--main">
                    @include('rankings._main_column', [
                        'mode' => $ruleset,
                        'object' => $stats->user,
                        'showAvatar' => true,
                        'showTeam' => false,
                        'sort' => null,
                        'type' => $sort,
                    ])
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ format_percentage($stats->accuracy_new / 100) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ i18n_number_format($stats->playcount) }}
                </td>
                <td class="{{ class_with_modifiers('ranking-page-table__column', ['dimmed' => $sort !== 'score']) }}">
                    {{ i18n_number_format(round($stats->ranked_score)) }}
                </td>
                <td class="{{ class_with_modifiers('ranking-page-table__column', ['dimmed' => $sort !== 'performance']) }}">
                    {{ i18n_number_format($stats->rank_score) ?? '-' }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    @php
                        $rank = $stats->globalRank();
                    @endphp
                    {{ $rank === null ? '-' : '#'.i18n_number_format($rank) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ i18n_number_format(max(0, $stats->x_rank_count + $stats->xh_rank_count)) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ i18n_number_format(max(0, $stats->s_rank_count + $stats->sh_rank_count)) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ i18n_number_format(max(0, $stats->a_rank_count)) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
