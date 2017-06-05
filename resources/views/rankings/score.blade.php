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
                    {{ trans('rankings.stat.accuracy') }}
                </th>
                <th class="ranking-page-table__heading">
                    {{ trans('rankings.stat.play_count') }}
                </th>
                <th class="ranking-page-table__heading">
                    {{ trans('rankings.stat.total_score') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--focused">
                    {{ trans('rankings.stat.ranked_score') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--rank">
                    {{ trans('rankings.stat.ss') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--rank">
                    {{ trans('rankings.stat.s') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--rank">
                    {{ trans('rankings.stat.a') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $index => $score)
                <tr class="ranking-page-table__row{{$score['user']['is_active'] ? '' : ' ranking-page-table__row--inactive'}}">
                    <td class="ranking-page-table__rounded-left ranking-page-table__rank-column">
                        #{{ $scores->firstItem() + $index }}
                    </td>
                    <td>
                        <a class="ranking-page-table__user-link" href="/users/{{$score['user']['id']}}">
                            @include('objects._country-flag', [
                                'country_name' => $score['user']['country']['name'],
                                'country_code' => $score['user']['country']['code'],
                            ])
                            <span class="ranking-page-table__user-link-text">
                                {{ $score['user']['username'] }}
                            </span>
                        </a>
                    </td>
                    <td class="ranking-page-table__column--dimmed">
                        {{ format_percentage($score['hit_accuracy']) }}
                    </td>
                    <td class="ranking-page-table__column--dimmed">
                        {{ number_format($score['play_count']) }}
                    </td>
                    <td class="ranking-page-table__column--dimmed">
                        {!! suffixed_number_format_tag($score['total_score']) !!}
                    </td>
                    <td class="ranking-page-table__column--focused">
                        {!! suffixed_number_format_tag($score['ranked_score']) !!}
                    </td>
                    <td class="ranking-page-table__column--dimmed">
                        {{ number_format($score['grade_counts']['ss']) }}
                    </td>
                    <td class="ranking-page-table__column--dimmed">
                        {{ number_format($score['grade_counts']['s']) }}
                    </td>
                    <td class="ranking-page-table__column--dimmed ranking-page-table__rounded-right">
                        {{ number_format($score['grade_counts']['a']) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
