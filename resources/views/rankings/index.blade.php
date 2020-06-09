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

    @if ($type !== 'country')
        <div class="osu-page osu-page--description">
            <div class="js-react--ranking-filter" data-type="{{ $type }}">
                {{-- placeholder so the page doesn't shift after react initializes --}}
                <div class="ranking-filter">
                    <div class="ranking-filter__countries">
                        @if ($type === 'performance')
                            <div class="ranking-select-options">
                                <div class="ranking-select-options__select">
                                    <div class="ranking-select-options__option">{{ optional($country)->name ?? trans('rankings.countries.all') }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if (auth()->check())
                        <div class="ranking-filter__sort">
                            <div class="sort">
                                <div class="sort__items">
                                    <span class="sort__item sort__item--title">{{ trans('rankings.filter.title') }}</span>
                                    <button class="sort__item sort__item--button">{{ trans('sort.all') }}</button>
                                    <button class="sort__item sort__item--button">{{ trans('sort.friends')}}</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
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

@section("script")
    @parent

    @if (isset($countries))
        <script id="json-countries" type="application/json">
            {!! json_encode($countries) !!}
        </script>
    @endif
@endsection
