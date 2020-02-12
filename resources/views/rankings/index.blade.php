{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
@php
    $selectorParams = [
        'type' => $type,
        'mode' => $mode,
        'route' => function($routeMode, $routeType) use ($country, $spotlight) {
            if ($routeType === 'country') {
                return route('rankings', ['mode' => $routeMode, 'type' => $routeType]);
            }

            return trim(route('rankings', [
                'mode' => $routeMode,
                'type' => $routeType,
                'spotlight' => $routeType === 'charts' ? $spotlight ?? null : null,
                'country' => $routeType === 'performance' ? $country['acronym'] : null,
            ]), '?');
        }
    ];

    $links = [];
    foreach (['performance', 'charts', 'score', 'country'] as $tab) {
        $links[] = [
            'active' => $tab === $type,
            'title' => trans("rankings.type.{$tab}"),
            'url' => $selectorParams['route']($mode, $tab),
        ];
    }
@endphp

@extends('master')

@section('content')
    @component('layout._page_header_v4', ['params' => [
        'links' => $links,
        'section' => trans('layout.header.rankings._'),
        'subSection' => trans("rankings.type.{$type}"),
        'theme' => 'rankings',
    ]])
        @slot('titleAppend')
            @include('rankings._mode_selector', $selectorParams)
        @endslot
    @endcomponent

    @yield('ranking-header')

    @if (isset($country))
        <div class="osu-page osu-page--description">
            <div class="ranking-country-filter">
                {{ trans('rankings.country.filter') }}:
                <div class="ranking-country-filter__item">
                    <div class="ranking-country-filter__flag">
                        @include('objects._country_flag', [
                            'country_code' => $country['acronym'],
                        ])
                    </div>
                    {{ $country['name'] }}
                    <a
                        class="ranking-country-filter__remove"
                        href="{{ route('rankings', compact('mode', 'type')) }}"
                    >
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <div class="osu-page osu-page--rankings">
        @if ($hasPager)
            @include('objects._pagination_v2', [
                'object' => $scores
                    ->appends(['country' => $country['acronym']])
                    ->fragment('scores')
            ])
        @endif

        <div class="ranking-page">
            <div class="ranking-page__jump-target" id="scores"></div>
            @yield('scores')
        </div>

        @yield('ranking-footer')

        @if ($hasPager)
            @include('objects._pagination_v2', [
                'object' => $scores
                    ->appends(['country' => $country['acronym']])
                    ->fragment('scores')
            ])
        @endif
    </div>
@endsection
