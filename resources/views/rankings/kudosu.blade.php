{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
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
                <th></th>
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
            @php
                $firstItem = $scores->firstItem();
            @endphp
            @foreach ($scores as $index => $user)
                <tr class="{{ class_with_modifiers('ranking-page-table__row', ['inactive' => !$user->isActive()]) }}">
                    <td class="ranking-page-table__column">
                        #{{ i18n_number_format($firstItem + $index) }}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--main">
                        @include('rankings._main_column', ['object' => $user])
                    </td>
                    <td class="ranking-page-table__column">
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
