{{--
    Copyright 2015-2017 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends("rankings.index")

@section("scores")
    <table class="ranking-page-table">
        <thead>
            <tr>
                <th class="ranking-page-table__heading ranking-page-table__heading--main" colspan="2"></th>
                <th class="ranking-page-table__heading">
                    {{ trans('rankings.stat.active_users') }}
                </th>
                <th class="ranking-page-table__heading">
                    {{ trans('rankings.stat.play_count') }}
                </th>
                <th class="ranking-page-table__heading">
                    {{ trans('rankings.stat.ranked_score') }}
                </th>
                <th class="ranking-page-table__heading">
                    {{ trans('rankings.stat.average_score') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--focused">
                    {{ trans('rankings.stat.performance') }}
                </th>
                <th class="ranking-page-table__heading">
                    {{ trans('rankings.stat.average_performance') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $index => $score)
                <tr class="ranking-page-table__row">
                    <td class="ranking-page-table__rounded-left ranking-page-table__rank-column">
                        #{{ $scores->firstItem() + $index }}
                    </td>
                    <td>
                        <a class="ranking-page-table__user-link" href="{{route('rankings', [
                            'mode' => $mode,
                            'type' => 'performance',
                            'country' => $score['code'],
                        ])}}">
                            @include('objects._country_flag', [
                                'country_code' => $score['country']['code'],
                            ])
                            <span class="ranking-page-table__user-link-text">
                                {{ $score['country']['name'] }}
                            </span>
                        </a>
                    </td>
                    <td class="ranking-page-table__column--dimmed">
                        {{ number_format($score['active_users']) }}
                    </td>
                    <td class="ranking-page-table__column--dimmed">
                        {!! suffixed_number_format_tag($score['play_count']) !!}
                    </td>
                    <td class="ranking-page-table__column--dimmed">
                        {!! suffixed_number_format_tag($score['ranked_score']) !!}
                    </td>
                    <td class="ranking-page-table__column--dimmed">
                        {!! suffixed_number_format_tag(round($score['ranked_score'] / max($score['active_users'], 1))) !!}
                    </td>
                    <td class="ranking-page-table__column--focused">
                        {!! suffixed_number_format_tag(round($score['performance'])) !!}
                    </td>
                    <td class="ranking-page-table__column--dimmed ranking-page-table__rounded-right">
                        {{ number_format(round($score['performance'] / max($score['active_users'], 1))) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
