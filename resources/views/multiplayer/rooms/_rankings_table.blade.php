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
        @foreach ([$userScore, ...$scores] as $index => $score)
            @if ($score === null)
                @continue
            @endif
            @php
                $rank = $loop->first
                    ? $score->userRank()
                    // -1 due to userScore being prepended
                    : $scores->firstItem() + $index - 1;
            @endphp
            <tr class="ranking-page-table__row{{$score->user->isActive() ? '' : ' ranking-page-table__row--inactive'}}">
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
                            href="{{ route('users.show', ['user' => $score->user_id, 'mode' => $mode ?? null]) }}"
                            class="ranking-page-table__user-link-text js-usercard"
                            data-user-id="{{ $score->user_id }}"
                            data-tooltip-position="right center"
                        >
                            {{ $score->user->username }}
                        </a>
                    </div>
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ format_percentage($score->averageAccuracy()) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                    {{ i18n_number_format($score->attempts) }}
                </td>
                <td class="ranking-page-table__column ranking-page-table__column--focused">
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
