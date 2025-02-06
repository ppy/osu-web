{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<table class="ranking-page-table">
    <thead>
        <tr>
            <th class="ranking-page-table__heading"></th>
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
        @foreach ($scores as $index => $score)
            @php
                $rank = $scores->firstItem() + $index;

                if (!isset($currentDivision) || $rank > $currentDivision['max_rank']) {
                    while (($currentDivision = array_shift($divisions)) !== null) {
                        if ($rank <= $currentDivision['max_rank']) {
                            break;
                        }
                    }
                }
            @endphp

            <tr class="{{ class_with_modifiers('ranking-page-table__row', ['inactive' => !$score->user->isActive()]) }}">
                <td class="ranking-page-table__column ranking-page-table__column--rank">
                    #{{ $rank }}
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
                            href="{{ route('users.show', ['user' => $score->user_id]) }}"
                            class="ranking-page-table__user-link-text js-usercard"
                            data-user-id="{{ $score->user_id }}"
                            data-tooltip-position="right center"
                        >
                            {{ $score->user->username }}
                        </a>
                    </div>
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ i18n_number_format($score->total_score) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--division">
                    {{ $currentDivision['division']->name ?? '' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
