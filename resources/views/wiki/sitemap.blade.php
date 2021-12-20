{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $urlFn = fn (string $locale): string => route('wiki.sitemap', compact('locale'));
    $sitemapUrl = $urlFn($locale);
    $availableLocales = new Ds\Set(config('app.available_locales'));
@endphp

@extends('wiki.layout', [
    'availableLocales' => $availableLocales,
    'canonicalUrl' => $sitemapUrl,
    'titlePrepend' => osu_trans('layout.header.help.sitemap'),
    'urlFn' => $urlFn,
])

@section('content')
    @component('layout._page_header_v4', ['params' => [
        'links' => [
            [
                'title' => osu_trans('layout.header.help.index'),
                'url' => wiki_url('Main_Page'),
            ],
            [
                'title' => osu_trans('layout.header.help.sitemap'),
                'url' => $sitemapUrl,
            ],
        ],
        'linksBreadcrumb' => true,
        'theme' => 'help',
    ]])

        @slot('navAppend')
            <div class="header-buttons">
                @if (priv_check('WikiPageRefresh')->can())
                    <div class="header-buttons__item">
                        <button
                            type="button"
                            class="btn-osu-big btn-osu-big--rounded-thin"
                            data-remote="true"
                            data-url="{{ $sitemapUrl }}"
                            data-method="PUT"
                            title="{{ osu_trans('wiki.show.edit.refresh') }}"
                        >
                            <i class="fas fa-sync"></i>
                        </button>
                    </div>
                @endif

                <div class="header-buttons__item">
                    @include('wiki._locale_menu', [
                        'availableLocales' => $availableLocales,
                        'displayLocale' => $locale,
                        'path' => 'Sitemap',
                    ])
                </div>
            </div>
        @endslot
    @endcomponent

    <div class="osu-page osu-page--generic">
        <h1>{{ osu_trans('layout.header.help.sitemap') }}</h1>
        <div class="osu-md">
            @include('wiki._sitemap_section', $sitemap)
        </div>
    </div>
@endsection
