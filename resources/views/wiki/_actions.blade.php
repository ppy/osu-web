{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $otherLocales = $page->otherLocales();
    $locale = $page->requestedLocale;

    // put back original page locale when showing fallback translation
    if ($page->isVisible() && $locale !== $page->locale && !in_array($page->locale, $otherLocales, true)) {
        array_unshift($otherLocales, $page->locale);
        sort($otherLocales);
    }
@endphp
<div class="header-buttons">
    <div class="header-buttons__item">
        <a
            class="btn-osu-big btn-osu-big--rounded-thin"
            href="{{ $page->editUrl() }}"
            title="{{ trans('wiki.show.edit.link') }}"
        >
            <i class="fab fa-github"></i>
        </a>
    </div>

    @if (priv_check('WikiPageRefresh')->can())
        <div class="header-buttons__item">
            <button
                type="button"
                class="btn-osu-big btn-osu-big--rounded-thin"
                data-remote="true"
                data-url="{{ wiki_url($page->path, $locale) }}"
                data-method="PUT"
                title="{{ trans('wiki.show.edit.refresh') }}"
            >
                <i class="fas fa-sync"></i>
            </button>
        </div>
    @endif

    <div class="header-buttons__item">
        @include('wiki._locale_menu', [
            'contentLocale' => $page->locale,
            'displayLocale' => $locale,
            'otherLocales' => $otherLocales,
            'path' => $page->path,
        ])
    </div>
</div>
