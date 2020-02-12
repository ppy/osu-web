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
    $links = [
        [
            'url' => route('contests.index'),
            'title' => trans('contest.index.nav_title'),
        ],
        [
            'url' => $contestMeta->url(),
            'title' => $contestMeta->name,
        ],
    ];
@endphp

@extends('master', [
    'currentSection' => 'community',
    'currentAction' => 'contests',
    'legacyFont' => false,
    'title' => "Contest: {$contestMeta->name}",
    'pageDescription' => strip_tags(markdown($contestMeta->currentDescription())),
    'canonicalUrl' => $contestMeta->url(),
    'opengraph' => [
        'title' => $contestMeta->name,
        'section' => trans('layout.menu.community.contests'),
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
        'section' => trans('layout.header.community._'),
        'subSection' => trans('layout.header.community.contests'),
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
