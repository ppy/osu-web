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
                {{ osu_trans('rankings.stat.total_score') }}
            </th>
            <th class="ranking-page-table__heading ranking-page-table__heading--focused">
                {{ osu_trans('rankings.stat.division') }}
            </th>
        </tr>
    </thead>

    <tbody>
        @php
            $firstItem = $scores->firstItem();
        @endphp
        @foreach ($scores as $index => $score)
            @php
                $rank = $firstItem + $index;

                if (!isset($currentDivision) || $rank > $currentDivision['max_rank']) {
                    while (($currentDivision = array_shift($divisions)) !== null) {
                        if ($rank <= $currentDivision['max_rank']) {
                            break;
                        }
                    }
                }
            @endphp
            <tr class="{{ class_with_modifiers('ranking-page-table__row', ['inactive' => !$score->user->isActive()]) }}">
                <td class="ranking-page-table__column">
                    #{{ i18n_number_format($rank) }}
                </td>
                <td class="ranking-page-table__column">
                    <div class="ranking-page-table__user-link">
                        <span class="ranking-page-table__flags">
                            @include('objects._flag_country', [
                                'country' => $score->user->country,
                            ])
                            @if (($team = $score->user->team) !== null)
                                <a class="u-contents" href="{{ route('teams.show', $team) }}">
                                    @include('objects._flag_team', compact('team'))
                                </a>
                            @endif
                        </span>
                        <a
                            class="u-ellipsis-overflow js-usercard"
                            data-overflow-tooltip-disabled="1"
                            data-tooltip-position="right center"
                            data-user-id="{{ $score->user_id }}"
                            href="{{ route('users.show', ['user' => $score->user_id]) }}"
                        >
                            {{ $score->user->username }}
                        </a>
                    </div>
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ i18n_number_format($score->total_score) }}
                </td>
                <td class="ranking-page-table__column">
                    {{ $currentDivision['division']->name ?? '' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
