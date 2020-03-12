{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => trans('layout.header.help.sitemap'),
])

@section('content')
    @component('layout._page_header_v4', ['params' => [
        'links' => [
            [
                'title' => trans('layout.header.help.index'),
                'url' => wiki_url('Main_Page'),
            ],
            [
                'title' => trans('layout.header.help.sitemap'),
                'url' => route('wiki.sitemap'),
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
                            data-url="{{ route('wiki.sitemap') }}"
                            data-method="PUT"
                            title="{{ trans('wiki.show.edit.refresh') }}"
                        >
                            <i class="fas fa-sync"></i>
                        </button>
                    </div>
                @endif
            </div>
        @endslot
    @endcomponent

    <div class="osu-page osu-page--generic">
        <h1>{{ trans('layout.header.help.sitemap') }}</h1>
        <div class="osu-md">
            <ul class="osu-md__list">
                @foreach ($sitemap as $key => $value)
                    @include('wiki._sitemap_section', ['section' => $key, 'sitemap' => $value, 'titles' => $titles])
                @endforeach
            </ul>
        </div>
    </div>
@endsection
