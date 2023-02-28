{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $links = [
        [
            'url' => route('contests.index'),
            'title' => osu_trans('contest.index.nav_title'),
        ],
        [
            'url' => $contestMeta->url(),
            'title' => $contestMeta->name,
        ],
    ];
@endphp

@extends('master', [
    'titlePrepend' => $contestMeta->name,
    'pageDescription' => strip_tags(markdown($contestMeta->currentDescription())),
    'canonicalUrl' => $contestMeta->url(),
    'opengraph' => [
        'title' => $contestMeta->name,
        'image' => $contestMeta->header_url,
    ],
])

@section('content')
    <style>
        :root { {{ css_var_2x('--header-bg', $contestMeta->header_url) }} }
    </style>

    @include('layout._page_header_v4', ['params' => [
        'links' => $links,
        'linksBreadcrumb' => true,
        'theme' => 'contests',
    ]])

    <div class="osu-page">
        <div class="page-image">
            {!! img2x([
                'src' => $contestMeta->header_url,
                'class' => 'page-image__image',
            ]) !!}

            <h1 class="page-image__title">
                {{ $contestMeta->name }}
            </h1>
        </div>

        <div class="contest">
            @yield('contest-content')
        </div>
    </div>
@endsection
