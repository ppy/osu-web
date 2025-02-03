{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $firstScoreRank = $scores->firstItem();
@endphp
@extends('rankings.index', [
    'hasFilter' => false,
    'hasMode' => false,
    'hasPager' => true,
    'type' => 'kudosu',
])

@section('scores')
    <table class="ranking-page-table ranking-page-table--kudosu">
        <thead>
            <tr>
                <th class="ranking-page-table__heading"></th>
                <th class="ranking-page-table__heading ranking-page-table__heading--main"></th>
                <th class="ranking-page-table__heading ranking-page-table__heading--focused ranking-page-table__heading--grade">
                    {{ osu_trans('rankings.kudosu.total') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--grade">
                    {{ osu_trans('rankings.kudosu.available') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--grade">
                    {{ osu_trans('rankings.kudosu.used') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $index => $user)
                <tr class="{{ class_with_modifiers('ranking-page-table__row', ['inactive' => !$user->isActive()]) }}">
                    <td class="ranking-page-table__column ranking-page-table__column--rank">
                        #{{ i18n_number_format($index + $firstScoreRank) }}
                    </td>
                    <td class="ranking-page-table__column">
                        <div class="ranking-page-table__user-link">
                            <span class="ranking-page-table__flags">
                                @include('objects._flag_country', [
                                    'country' => $user->country_acronym,
                                ])

                                @if (($team = $user->team) !== null)
                                    <a class="u-contents" href="{{ route('teams.show', $team) }}">
                                        @include('objects._flag_team', compact('team'))
                                    </a>
                                @endif
                            </span>
                            {!! link_to_user($user, null, '', ['ranking-page-table__user-link-text']) !!}
                        </div>
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--focused">
                        {{ i18n_number_format($user->osu_kudostotal) }}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                        {{ i18n_number_format($user->osu_kudosavailable) }}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                        {{ i18n_number_format($user->osu_kudostotal - $user->osu_kudosavailable) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
