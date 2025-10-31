{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Http\Controllers\RankingController;

    $links = [];
    foreach (RankingController::TYPES as $tab) {
        $links[] = [
            'active' => $tab === $params['type'],
            'title' => osu_trans("rankings.type.{$tab}"),
            'url' => RankingController::url([...$params, 'type' => $tab]),
        ];
    }

    $currentRoute ??= 'rankings';
    $hasFilter ??= true;
    $hasMode ??= true;
    $hasPager ??= true;
    $hasScores ??= true;
@endphp

@extends('master', ['titlePrepend' => $titlePrepend ?? osu_trans("rankings.type.{$params['type']}")])

@if ($hasMode)
    @section('rulesetSelector')
        @include('objects._ruleset_selector', [
            'currentRuleset' => $params['mode'],
            'urlFn' => fn (string $r): string => route($currentRoute, [
                ...$params,
                'mode' => $r,
                'variant' => $r === $params['mode'] ? ($params['variant'] ?? null) : null,
            ]),
        ])
    @endsection
@endif

@section('content')
    @component('layout._page_header_v4', ['params' => [
        'links' => $links,
        'theme' => 'rankings',
    ]])
        @slot('contentAppend')
            @if ($hasMode)
                @yield('rulesetSelector')
            @endif
        @endslot

        @slot('linksAppend')
            @yield('additionalHeaderLinks')
            @if ($hasMode)
                <div class="visible-xs">
                    @yield('rulesetSelector')
                </div>
            @endif
        @endslot
    @endcomponent

    @yield('ranking-header')

    @if ($hasScores)
        <div class="osu-page osu-page--generic">
            @yield('scores-header')

            <div id="scores"></div>
            @if ($hasPager)
                @include('objects._pagination_v2', [
                    'object' => $scores->fragment('scores')
                ])
            @endif

            <div class="ranking-page">
                @yield('scores')
            </div>

            @if ($hasPager)
                @include('objects._pagination_v2', [
                    'object' => $scores->fragment('scores')
                ])
            @endif

            @yield('ranking-footer')
        </div>
    @endif
@endsection
