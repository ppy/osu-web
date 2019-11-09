{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @php
        $selectorParams = [
            'type' => $type,
            'mode' => $mode,
            'route' => function($routeMode, $routeType) use ($country, $spotlight) {
                return trim(route('rankings', [
                    'mode' => $routeMode,
                    'type' => $routeType,
                    'spotlight' => $routeType === 'charts' ? $spotlight ?? null : null,
                    'country' => $routeType === 'performance' ? $country['acronym'] : null,
                ]), '?');
            }
        ];
    @endphp
    <div class="osu-page">
        @include('rankings._mode_selector', $selectorParams)
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
            @yield('ranking-header')
        </div>
    </div>
    <div class="osu-page osu-page--small osu-page--rankings">
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
