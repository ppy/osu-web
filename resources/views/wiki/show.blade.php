{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
    'bodyAdditionalClasses' => 'osu-layout--body-333',
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

            <div class="osu-page-header__actions">
                <div class="forum-post-actions">
                    <div class="forum-post-actions__action">
                        <a
                            class="btn-circle"
                            href="{{ $page->editUrl() }}"
                            title="{{ trans('wiki.show.edit.link') }}"
                            data-tooltip-position="left center"
                        >
                            <span class="btn-circle__content">
                                <i class="fab fa-github"></i>
                            </span>
                        </a>
                    </div>

                    @if (priv_check('WikiPageRefresh')->can())
                        <div class="forum-post-actions__action">
                            <button
                                type="button"
                                class="btn-circle"
                                data-remote="true"
                                data-url="{{ route('wiki.show', [$page->path]) }}"
                                data-method="PUT"
                                title="{{ trans('wiki.show.edit.refresh') }}"
                                data-tooltip-position="left center"
                            >
                                <span class="btn-circle__content">
                                    <i class="fas fa-sync"></i>
                                </span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="osu-page osu-page--wiki">
        @if ($page->page() !== null && $page->locale !== $page->requestedLocale)
            <div class="wiki-notice">
                <div class="wiki-notice__box">
                    {{ trans('wiki.show.fallback_translation', ['language' => locale_name($page->requestedLocale)]) }}
                </div>
            </div>
        @endif

        @if ($page->isLegalTranslation())
            <div class="wiki-notice">
                <div class="wiki-notice__box wiki-notice__box--important">
                    {!! trans('wiki.show.translation.legal', [
                        'default' => '<a href="'.e(wiki_url($page->path, config('app.fallback_locale'))).'">'.e(trans('wiki.show.translation.default')).'</a>',
                    ]) !!}
                </div>
            </div>
        @endif

        @if ($page->isOutdated())
            <div class="wiki-notice">
                <div class="wiki-notice__box">
                    {!! trans('wiki.show.translation.outdated', [
                        'default' => '<a href="'.e(wiki_url($page->path, config('app.fallback_locale'))).'">'.e(trans('wiki.show.translation.default')).'</a>',
                    ]) !!}
                </div>
            </div>
        @endif

        <div class="wiki-page">
            <div class="hidden-xs wiki-page__toc">
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
