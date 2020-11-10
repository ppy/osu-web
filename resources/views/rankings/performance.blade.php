{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends("rankings.index")

@section("scores")
    <table class="ranking-page-table">
        <thead>
            <tr>
                <th class="ranking-page-table__heading"></th>
                <th class="ranking-page-table__heading ranking-page-table__heading--main"></th>
                <th class="ranking-page-table__heading">
                    {{ trans('rankings.stat.accuracy') }}
                </th>
                <th class="ranking-page-table__heading">
                    {{ trans('rankings.stat.play_count') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--focused">
                    {{ trans('rankings.stat.performance') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--grade">
                    {{ trans('rankings.stat.ss') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--grade">
                    {{ trans('rankings.stat.s') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--grade">
                    {{ trans('rankings.stat.a') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $index => $score)
                <tr class="ranking-page-table__row{{$score->user->isActive() ? '' : ' ranking-page-table__row--inactive'}}">
                    <td class="ranking-page-table__column ranking-page-table__column--rank">
                        #{{ $scores->firstItem() + $index }}
                    </td>
                    <td class="ranking-page-table__column">
                        <div class="ranking-page-table__user-link">
                            <a
                                href="{{ route('rankings', [
                                    'mode' => $mode,
                                    'type' => 'performance',
                                    'country' => $score->user->country->acronym,
                                    'variant' => $variant,
                                ]) }}"
                            >
                                @include('objects._flag_country', [
                                    'countryName' => $score->user->country->name,
                                    'countryCode' => $score->user->country->acronym,
                                    'modifiers' => ['medium'],
                                ])
                            </a>
                            <a
                                href="{{ route('users.show', ['user' => $score->user_id, 'mode' => $mode]) }}"
                                class="ranking-page-table__user-link-text js-usercard"
                                data-user-id="{{ $score->user_id }}"
                                data-tooltip-position="right center"
                            >
                                {{ $score->user->username }}
                            </a>
                        </div>
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                        {{ format_percentage($score->accuracy_new) }}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                        {{ i18n_number_format($score->playcount) }}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--focused">
                        {{ i18n_number_format(round($score->rank_score)) }}
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
@endsection
