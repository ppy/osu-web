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
    'body_additional_classes' => 'osu-layout--body-333',
    'title' => null,
    'titleAppend' => (present($page->subtitle()) ? $page->subtitle().' / ' : '').$page->title(),
])

@section('content')
    <div class="osu-layout__row">
        <div class="osu-page-header osu-page-header--wiki">
            <div class="osu-page-header__title-box">
                @if (present($page->subtitle()))
                    <h2 class="osu-page-header__title osu-page-header__title--small">
                        {{ $page->subtitle() }}
                    </h2>
                @endif

                <h1 class="osu-page-header__title osu-page-header__title--main">
                    {{ $page->title() }}
                </h1>
            </div>

            @if (!empty($page->locales()))
                <div class="osu-page-header__actions">
                    <div class="forum-post-actions">
                        <div class="forum-post-actions__action">
                            <a
                                class="btn-circle"
                                href="{{ $page->editUrl() }}"
                                title="{{ trans('wiki.show.edit.link') }}"
                                data-tooltip-position="left center"
                            >
                                <i class="fa fa-github"></i>
                            </a>
                        </div>

                        @if (priv_check('WikiPageRefresh')->can())
                            <div class="forum-post-actions__action">
                                <a
                                    class="btn-circle"
                                    href="#"
                                    data-remote="true"
                                    data-method="PUT"
                                    title="{{ trans('wiki.show.edit.refresh') }}"
                                    data-tooltip-position="left center"
                                >
                                    <i class="fa fa-refresh"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="osu-page osu-page--wiki">
        @if (count($page->locales()) > 0)
            <div class="wiki-language-list">
                <div class="wiki-language-list__header">
                    {{ trans('wiki.show.languages') }}:
                </div>

                @foreach ($page->locales() as $locale)
                    @if ($locale === $page->requestedLocale)
                        <span class="wiki-language-list__item wiki-language-list__item--current">
                            {{ App\Libraries\LocaleMeta::nameFor($locale) }}
                        </span>
                    @else
                        <a class="wiki-language-list__item wiki-language-list__item--link" href="?locale={{ $locale }}">
                            {{ App\Libraries\LocaleMeta::nameFor($locale) }}
                        </a>
                    @endif
                @endforeach
            </div>
        @endif

        @if ($page->page() !== null && $page->locale !== $page->requestedLocale)
            <div class="wiki-fallback-locale">
                <div class="wiki-fallback-locale__box">
                    {{ trans('wiki.show.fallback_translation', ['language' => locale_name($page->requestedLocale)]) }}
                </div>
            </div>
        @endif

        <div class="wiki-page">
            <div
                class="hidden-xs wiki-page__toc js-wiki-toc-float-container js-sticky-header"
                data-sticky-header-target="wiki-toc"
            >
                <div class="js-sync-height--target" data-sync-height-id="wiki-toc"></div>

                <div
                    class="wiki-toc js-wiki-toc js-wiki-toc-float js-sync-height--reference"
                    data-sync-height-target="wiki-toc"
                >
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
                        @if (empty($page->locales()))
                            {{ trans('wiki.show.missing') }}
                        @else
                            {{ trans('wiki.show.missing_translation') }}
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
