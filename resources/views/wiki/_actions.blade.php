{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $requestedLocale = $page->requestedLocale;
@endphp
<div class="header-buttons">
    <div class="header-buttons__item">
        <a
            class="btn-osu-big btn-osu-big--rounded-thin"
            href="{{ $page->editUrl() }}"
            title="{{ osu_trans('wiki.show.edit.link') }}"
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
                data-url="{{ wiki_url($page->path, $requestedLocale) }}"
                data-method="PUT"
                title="{{ osu_trans('wiki.show.edit.refresh') }}"
            >
                <i class="fas fa-sync"></i>
            </button>
        </div>
    @endif

    <div class="header-buttons__item">
        @include('wiki._locale_menu', [
            'availableLocales' => $page->availableLocales(),
            'displayLocale' => $requestedLocale,
            'path' => $page->path,
        ])
    </div>
</div>
