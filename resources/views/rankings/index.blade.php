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
@extends('master')

@section("content")
    @php
        $selectorParams = [
            'type' => $type,
            'mode' => $mode,
            'route' => function($mode, $type) use ($country) {
                return trim(route('rankings', [
                    'mode' => $mode,
                    'type' => $type,
                    'country' => $country['acronym'],
                ]), '?');
            }
        ];
    @endphp
    <div class="osu-page">
        @include('objects._mode_selector', $selectorParams)
        <div class="ranking-page-header">
            @include('rankings._type_selector', $selectorParams)
            <hr class="page-mode__underline">

            <div class='ranking-page-header__title'>
                @if (isset($country))
                    <a class='ranking-page-header__flag' href="{{route('rankings', ['mode' => $mode, 'type' => $type])}}">
                        @include('objects._country_flag', [
                            'country_code' => $country['acronym'],
                            'country_name' => $country['name'],
                        ])
                        <div class='ranking-page-header__flag-overlay'><i class="fas fa-fw fa-times"></i></div>
                    </a>
                @endif
                {!! trans('rankings.header', [
                    'type' => "<span class='ranking-page-header__title-type'>".trans("rankings.type.{$type}")."</span>"
                ]) !!}
            </div>
        </div>
    </div>
    <div class="osu-page osu-page--small osu-page--rankings">
        @include('objects._pagination', [
            'object' => $scores
                ->appends(['country' => $country['acronym']])
                ->fragment('scores')
        ])

        <div class="ranking-page">
            <div class="ranking-page__jump-target" id="scores"></div>
            @yield('scores')
        </div>

        @include('objects._pagination', [
            'object' => $scores
                ->appends(['country' => $country['acronym']])
                ->fragment('scores')
        ])
    </div>
@endsection
