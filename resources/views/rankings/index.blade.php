{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $mode ??= default_mode();
    $selectorParams = [
        'type' => $type,
        'mode' => $mode,
        'route' => function($routeMode, $routeType) use ($country, $spotlight) {
            if ($routeType === 'country') {
                return route('rankings', ['mode' => $routeMode, 'type' => $routeType]);
            }

            if ($routeType === 'multiplayer') {
                return route('multiplayer.rooms.show', ['room' => 'latest']);
            }
            if ($routeType === 'seasons') {
                return route('seasons.show', ['season' => 'latest']);
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
    foreach (['performance', 'charts', 'score', 'country', 'multiplayer', 'seasons'] as $tab) {
        $links[] = [
            'active' => $tab === $type,
            'title' => osu_trans("rankings.type.{$tab}"),
            'url' => $selectorParams['route']($mode, $tab),
        ];
    }

    $hasMode = $hasMode ?? true;
    $hasScores = $hasScores ?? true;
@endphp

@extends('master', ['titlePrepend' => $titlePrepend ?? osu_trans("rankings.type.{$type}")])

@section('content')
    @component('layout._page_header_v4', ['params' => [
        'links' => $links,
        'theme' => 'rankings',
    ]])
        @slot('linksAppend')
            @if($hasMode)
                @include('rankings._mode_selector', $selectorParams)
            @endif

            @yield('additionalHeaderLinks')
        @endslot
    @endcomponent

    @yield('ranking-header')

    @if ($hasScores)
        <div class="osu-page osu-page--generic" id="scores">
            @if ($hasPager)
                @include('objects._pagination_v2', [
                    'object' => $scores
                        ->appends(['country' => $country['acronym'] ?? null])
                        ->fragment('scores')
                ])
            @endif

            <div class="ranking-page">
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
    @endif
@endsection
