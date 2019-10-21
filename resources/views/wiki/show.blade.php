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

@extends('master', [
    'title' => null,
    'titlePrepend' => $page->title(true),
])

@section('content')
    <div class="osu-layout__row">
        <div class="osu-page-header osu-page-header--wiki">
            <div class="osu-page-header__title-box">
                @if (present($page->subtitle()))
                    <h2 class="osu-page-header__title osu-page-header__title--small">
                        @if ($page->hasParent())
                            <a class="osu-page-header__link" href="{{ wiki_url($page->parentPath(), $page->requestedLocale) }}">
                                {{ $page->subtitle() }}
                            </a>
                        @else
                            {{ $page->subtitle() }}
                        @endif
                    </h2>
                @endif

                <h1 class="osu-page-header__title osu-page-header__title--main">
                    <a class="osu-page-header__link osu-page-header__link--plain" href="{{ wiki_url($page->path, $page->requestedLocale) }}">
                        {{ $page->title() }}
                    </a>
                </h1>
            </div>

            @include('wiki._actions')
        </div>
    </div>

    <div class="osu-page osu-page--wiki">
        @include('wiki._notice')

        <div class="wiki-page">
            <div class="hidden-xs wiki-page__toc u-fancy-scrollbar">
                <div class="wiki-toc">
                    <h2 class="wiki-toc__title">
                        {{ trans('wiki.show.toc') }}
                    </h2>

                    @if ($page->page() !== null)
                        @include('wiki._toc')
                    @endif
                </div>
            </div>

            <div class="wiki-page__content">
                @if ($page->page() !== null)
                    {!! $page->page()['output'] !!}
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
