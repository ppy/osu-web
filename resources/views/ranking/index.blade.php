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
    @php
        $selectorParams = [
            'type' => $type,
            'mode' => $mode,
            'route' => function($mode, $type) use ($country) {
                return route('ranking', [
                    'mode' => $mode,
                    'type' => $type,
                    'country' => $country['acronym'],
                ]);
            }
        ];
    @endphp
    <div class="osu-page">
        @include('objects._mode-selector', $selectorParams)
        <div class="ranking-page-header">
            @include('ranking._type-selector', $selectorParams)
            <hr class="page-mode__underline">

            <div class='ranking-page-header__title'>
                @if ($country !== null)
                    @include('objects._country-flag', [
                        'country_name' => $country['name'],
                        'country_code' => $country['acronym'],
                    ])
                @endif

                {!! trans('ranking.header', [
                    'type' => "<span class='ranking-page-header__title-type'>".trans("ranking.type.{$type}")."</span>"
                ]) !!}
            </div>
        </div>
    </div>
    <div class="osu-page osu-page--small ranking-page">
        @yield("scores")
        @include('objects._pagination', ['object' => $scores->appends(['country' => $country['acronym']])])
    </div>
@endsection
