{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $currentUser = Auth::user();
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
    'canonicalUrl' => $contestMeta->url(),
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

        @if ($currentUser !== null && $currentUser->isAdmin())
            <div class="admin-menu">
                <button class="admin-menu__button js-menu" data-menu-target="admin-menu-forums-show">
                    <span class="fas fa-angle-up"></span>
                    <span class="admin-menu__button-icon fas fa-tools"></span>
                </button>

                <div class="admin-menu__menu js-menu" data-menu-id="admin-menu-forums-show" data-visibility="hidden">
                    <a class="admin-menu-item" href="{{ route('admin.contests.show', $contestMeta->id) }}" target="_blank">
                        <span class="admin-menu-item__content">
                            <span class="admin-menu-item__label admin-menu-item__label--icon">
                                <span class="fas fa-list-alt"></span>
                            </span>

                            <span class="admin-menu-item__label admin-menu-item__label--text">
                                {{ osu_trans('contest.show.admin.page') }}
                            </span>
                        </span>
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
