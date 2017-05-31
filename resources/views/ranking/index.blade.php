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
@extends("master")

@section("content")
    <div class="osu-page">
        <ul class="page-mode">
            <li class="page-mode__item">
                <a class="page-mode-link{{$mode == 'osu' ? ' page-mode-link--is-active' : ''}}"
                    href="{{route('ranking', ['mode' => 'osu', 'type' => $type])}}"
                >
                    {{trans('beatmaps.mode.osu')}}
                    <span class="page-mode-link__stripe"></span>
                </a>
            </li>
            <li class="page-mode__item">
                <a class="page-mode-link{{$mode == 'taiko' ? ' page-mode-link--is-active' : ''}}"
                    href="{{route('ranking', ['mode' => 'taiko', 'type' => $type])}}"
                >
                    {{trans('beatmaps.mode.taiko')}}
                    <span class="page-mode-link__stripe"></span>
                </a>
            </li>
            <li class="page-mode__item">
                <a class="page-mode-link{{$mode == 'fruits' ? ' page-mode-link--is-active' : ''}}"
                    href="{{route('ranking', ['mode' => 'fruits', 'type' => $type])}}"
                >
                    {{trans('beatmaps.mode.fruits')}}
                    <span class="page-mode-link__stripe"></span>
                </a>
            </li>
            <li class="page-mode__item">
                <a class="page-mode-link{{$mode == 'mania' ? ' page-mode-link--is-active' : ''}}"
                    href="{{route('ranking', ['mode' => 'mania', 'type' => $type])}}"
                >
                    {{trans('beatmaps.mode.mania')}}
                    <span class="page-mode-link__stripe"></span>
                </a>
            </li>
        </ul>
        <div class="ranking-page-header">
            <ul class="page-mode page-mode--ranking-page-mode-tabs">
                <li class="page-mode__item">
                    <a class="page-mode-link page-mode-link--white{{$type == 'performance' ? ' page-mode-link--is-active' : ''}}"
                        href="{{route('ranking', ['mode' => $mode, 'type' => 'performance'])}}"
                    >
                      {{trans('ranking.type.performance')}}
                        <span class="page-mode-link__stripe page-mode-link__stripe--black"></span>
                    </a>
                </li>
                <li class="page-mode__item">
                      <span class="page-mode-link page-mode-link--white page-mode-link--is-disabled" title="Coming soon!™">{{trans('ranking.type.charts')}}</span>
                </li>
                <li class="page-mode__item">
                    <a class="page-mode-link page-mode-link--white{{$type == 'score' ? ' page-mode-link--is-active' : ''}}"
                        href="{{route('ranking', ['mode' => $mode, 'type' => 'score'])}}"
                    >
                        {{trans('ranking.type.score')}}
                        <span class="page-mode-link__stripe page-mode-link__stripe--black"></span>
                    </a>
                </li>
                <li class="page-mode__item">
                    <span class="page-mode-link page-mode-link--white page-mode-link--is-disabled" title="Coming soon!™">{{trans('ranking.type.country')}}</span>
                </li>
            </ul>

            <hr class="page-mode__underline">

            <div class='ranking-page-header__title'>
                {!! trans('ranking.header', ['type' =>
                    "<span class='ranking-page-header__title-type'>".trans("ranking.type.{$type}")."</span>"
                ]) !!}
            </div>
        </div>
    </div>
    <div class="osu-page osu-page--small ranking-page">
        <table class="ranking-page-table">
            <thead>
                <tr>
                    <th class="ranking-page-table__heading ranking-page-table__heading--main" colspan="2">&nbsp;</th>
                    <th class="ranking-page-table__heading">{{trans('ranking.stat.accuracy')}}</th>
                    <th class="ranking-page-table__heading">{{trans('ranking.stat.play_count')}}</th>
                    <th class="ranking-page-table__heading ranking-page-table__heading--active">{{trans('ranking.stat.performance')}}</th>
                    <th class="ranking-page-table__heading ranking-page-table__heading--rank">{{trans('ranking.stat.ss')}}</th>
                    <th class="ranking-page-table__heading ranking-page-table__heading--rank">{{trans('ranking.stat.s')}}</th>
                    <th class="ranking-page-table__heading ranking-page-table__heading--rank">{{trans('ranking.stat.a')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scores as $index => $score)
                    <tr class="ranking-page-table__row{{$score['user']['is_active'] ? '' : ' ranking-page-table__row--inactive'}}">
                        <td class="ranking-page-table__rounded-left ranking-page-table__rank-column">#{{$scores->firstItem() + $index}}</td>
                        <td>
                            <a class="ranking-page-table__user-link" href="/users/{{$score['user']['id']}}">
                                <span class="flag-country"
                                    title="{{$score['user']['country_code']}}"
                                    style="background-image: url('/images/flags/{{$score['user']['country_code']}}.png');"
                                ></span>
                                <span class="ranking-page-table__user-link-text">
                                    {{$score['user']['username']}}
                                </span>
                            </a>
                        </td>
                        <td>{{sprintf("%01.2f", round($score['hit_accuracy'], 2))}}%</td>
                        <td>{{number_format($score['play_count'])}}</td>
                        <td>{{number_format(round($score['pp']))}} pp</td>
                        <td>{{number_format($score['grade_counts']['ss'])}}</td>
                        <td>{{number_format($score['grade_counts']['s'])}}</td>
                        <td class="ranking-page-table__rounded-right">{{number_format($score['grade_counts']['a'])}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('objects._pagination', ['object' => $scores])
    </div>
@endsection
