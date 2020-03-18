{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $url = wiki_url($page->path, $page->requestedLocale);
    $title = $page->title();

    $links = [
        [
            'title' => trans('layout.header.help.index'),
            'url' => wiki_url('Main_Page'),
        ],
    ];

    $parentTitle = presence($page->subtitle());
    if ($parentTitle !== null) {
        $link = ['title' => $parentTitle];
        if ($page->hasParent()) {
            $link['url'] = wiki_url($page->parentPath(), $page->requestedLocale);
        }
        $links[] = $link;
    }

    $links[] = compact('title', 'url');
@endphp

@extends('master', [
    'titlePrepend' => $page->title(true),
])

@section('content')
    @component('layout._page_header_v4', ['params' => [
        'links' => $links,
        'linksBreadcrumb' => true,
        'theme' => 'help',
    ]])
        @slot('navAppend')
            @include('wiki._actions')
        @endslot
    @endcomponent


    <div class="osu-page osu-page--wiki">
        <div class="wiki-page">
            <div class="hidden-xs wiki-page__toc u-fancy-scrollbar">
                <h2 class="wiki-page__toc-title">
                    {{ trans('wiki.show.toc') }}
                </h2>

                @if ($page->get() !== null)
                    @include('wiki._toc')
                @endif
            </div>

            <div class="wiki-page__content">
                @include('wiki._notice')

                @if ($page->get() !== null)
                    {!! $page->get()['output'] !!}
                @else
                    <div class="wiki-content">
                        <p>
                            {{ trans('wiki.show.missing', ['keyword' => $page->path ]) }}
                        </p>

                        <p>
                            {!! trans('wiki.show.search', ['link' =>
                                link_to(route('search', ['mode' => 'wiki_page', 'query' => $page->path]), $page->path)
                            ]) !!}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
