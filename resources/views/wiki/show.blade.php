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
    $url = wiki_url($page->path, $locale);
    $title = $page->title();
    $subSection = $title;

    $links = [
        [
            'title' => trans('layout.header.help.index'),
            'url' => wiki_url('Main_Page'),
        ],
    ];

    $parentTitle = presence($page->subtitle());
    if ($parentTitle !== null) {
        $link = ['title' => $parentTitle];
        $subSection = "{$parentTitle} / {$subSection}";
        if ($page->hasParent()) {
            $link['url'] = wiki_url($page->parentPath(), $locale);
        }
        $links[] = $link;
    }

    $links[] = compact('title', 'url');
@endphp

@extends('master', [
    'title' => null,
    'titlePrepend' => $page->title(true),
])

@section('content')
    @component('layout._page_header_v4', ['params' => [
        'links' => $links,
        'linksBreadcrumb' => true,
        'section' => trans('layout.header.help._'),
        'subSection' => $subSection,
        'theme' => 'help',
    ]])
        @slot('navAppend')
            @include('wiki._actions')
        @endslot
    @endcomponent


    <div class="osu-page osu-page--wiki">
        @include('wiki._notice')

        <div class="wiki-page">
            <div class="hidden-xs wiki-page__toc u-fancy-scrollbar">
                <div class="wiki-toc">
                    <h2 class="wiki-toc__title">
                        {{ trans('wiki.show.toc') }}
                    </h2>

                    @if ($page->get() !== null)
                        @include('wiki._toc')
                    @endif
                </div>
            </div>

            <div class="wiki-page__content">
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
