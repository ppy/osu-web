{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
                'country' => $routeType === 'performance' ? ($country['acronym'] ?? null) : null,
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

    $country_acronym = ($country['acronym'] ?? null) ?? optional(auth()->user())->country_acronym;
@endphp

@extends('master', ['titlePrepend' => trans("rankings.type.{$type}")])

@section('content')
    @component('layout._page_header_v4', ['params' => [
        'links' => $links,
        'theme' => 'rankings',
    ]])
        @slot('titleAppend')
            @include('rankings._mode_selector', $selectorParams)
        @endslot
    @endcomponent

    @yield('ranking-header')

    @if (auth()->check() && $type !== 'country')
        <div class="osu-page osu-page--description">
            <div class="game-mode">
                <ul class="game-mode__items">
                    <li class="game-mode__item">
                        <a class="game-mode-link" href="{{ route('rankings', compact('mode', 'type')) }}">
                            <span class="fake-bold">all</span>
                        </a>
                    </li>
                    @if (isset($country_acronym))
                        <li class="game-mode__item">
                            <a class="game-mode-link" href="?country={{ $country_acronym }}">
                                <span class="fake-bold">
                                    country
                                    <span class="ranking-country-filter__flag">
                                        @include('objects._country_flag', [
                                            'country_code' => $country_acronym,
                                        ])
                                    </span>
                                </span>
                            </a>
                        </li>
                    @endif
                    <li class="game-mode__item">
                        <a class="game-mode-link" href="?friends_only=true">
                            <span class="fake-bold">friends</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endif

    <div class="osu-page osu-page--generic">
        @if ($hasPager)
            @include('objects._pagination_v2', [
                'object' => $scores
                    ->appends(['country' => $country['acronym'] ?? null])
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
                    ->appends(['country' => $country['acronym'] ?? null])
                    ->fragment('scores')
            ])
        @endif
    </div>
@endsection
