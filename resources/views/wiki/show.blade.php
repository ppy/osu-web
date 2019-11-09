{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
