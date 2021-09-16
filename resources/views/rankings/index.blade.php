{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $selectorParams = [
        'type' => $type,
        'mode' => $mode,
        'route' => function($routeMode, $routeType) use ($country, $spotlight) {
            if ($routeType === 'multiplayer') {
                return route('multiplayer.rooms.show', ['room' => 'latest']);
            }

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
    foreach (['performance', 'charts', 'score', 'country', 'multiplayer'] as $tab) {
        $links[] = [
            'active' => $tab === $type,
            'title' => osu_trans("rankings.type.{$tab}"),
            'url' => $selectorParams['route']($mode, $tab),
        ];
    }

    if ($type === 'performance') {
        $variants = App\Models\Beatmap::VARIANTS[$mode] ?? null;

        if ($variants !== null) {
            array_unshift($variants, 'all');
        }
    }

    $hasMode = $hasMode ?? true;
    $hasFilter = $hasFilter ?? true;
@endphp

@extends('master', ['titlePrepend' => $titlePrepend ?? osu_trans("rankings.type.{$type}")])

@section('content')
    @component('layout._page_header_v4', ['params' => [
        'links' => $links,
        'theme' => 'rankings',
    ]])
        @if ($hasMode)
            @slot('titleAppend')
                @include('rankings._mode_selector', $selectorParams)
            @endslot
        @endif
    @endcomponent

    @yield('ranking-header')

    @if ($hasFilter)
        <div class="osu-page osu-page--description">
            <div
                class="js-react--ranking-filter"
                data-type="{{ $type }}"
                data-game-mode="{{ $mode }}"
                data-variants="{{ json_encode($variants ?? null) }}"
            >
                {{-- placeholder so the page doesn't shift after react initializes --}}
                <div class="ranking-filter">
                    <div class="ranking-filter__item ranking-filter__item--full">
                        @if ($type === 'performance')
                            <div class="ranking-filter__item--title">
                                {{ osu_trans('rankings.countries.title') }}
                            </div>
                            <div class="ranking-select-options">
                                <div class="ranking-select-options__select">
                                    <div class="ranking-select-options__option">{{ optional($country)->name ?? osu_trans('rankings.countries.all') }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if (auth()->check())
                        <div class="ranking-filter__item">
                            <div class="ranking-filter__item--title">
                                {{ osu_trans('rankings.filter.title') }}
                            </div>
                            <div class="sort">
                                <div class="sort__items">
                                    <button class="sort__item sort__item--button">{{ osu_trans('sort.all') }}</button>
                                    <button class="sort__item sort__item--button">{{ osu_trans('sort.friends')}}</button>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (isset($variants))
                        <div class="ranking-filter__item">
                            <div class="ranking-filter__item--title">
                                {{ osu_trans('rankings.filter.variant.title') }}
                            </div>
                            <div class="sort">
                                <div class="sort__items">
                                    @foreach ($variants as $v)
                                        <button class="sort__item sort__item--button">
                                            {{ osu_trans("beatmaps.variant.{$mode}.{$v}") }}
                                        </button>
                                    @endforeach
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
