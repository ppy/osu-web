{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $url = wiki_url($page->path, $page->requestedLocale);
    $title = $page->title();

    $links = [];

    if (!($legal ?? false)) {
        $links[] = [
            'title' => osu_trans('layout.header.help.index'),
            'url' => wiki_url('Main_Page', $page->requestedLocale),
        ];
    }

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

@extends('wiki.layout', [
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
            <div class="wiki-page__toc">
                <div class="sidebar">
                    <button
                        type="button"
                        class="sidebar__mobile-toggle js-mobile-toggle"
                        data-mobile-toggle-target="wiki-toc"
                    >
                        <h2 class="sidebar__title">
                            {{ osu_trans('wiki.show.toc') }}
                        </h2>

                        <div class="visible-xs sidebar__mobile-toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </button>

                    <div class="js-mobile-toggle hidden-xs sidebar__content" data-mobile-toggle-id="wiki-toc">
                        @if ($page->get() !== null)
                            @include('wiki._toc')
                        @endif
                    </div>
                </div>
            </div>

            <div class="wiki-page__content">
                @include('wiki._notice')

                @if ($page->get() !== null)
                    {!! $page->get()['output'] !!}
                @else
                    <div class="wiki-content">
                        <p>
                            {{ osu_trans('wiki.show.missing', ['keyword' => $page->path ]) }}
                        </p>

                        <p>
                            {!! osu_trans('wiki.show.search', ['link' =>
                                link_to(route('search', ['mode' => 'wiki_page', 'query' => $page->path]), $page->path)
                            ]) !!}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
