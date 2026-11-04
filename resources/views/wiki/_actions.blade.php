{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="header-buttons">
    <div class="header-buttons__item">
        <a
            class="btn-osu-big btn-osu-big--rounded-thin"
            href="{{ $page->editUrl() }}"
            title="{{ osu_trans('wiki.show.edit.link', [], $displayLocale) }}"
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
                data-url="{{ route('wiki.show', ['path' => $page->path, 'locale' => $displayLocale]) }}"
                data-method="PUT"
                title="{{ osu_trans('wiki.show.edit.refresh', [], $displayLocale) }}"
            >
                <i class="fas fa-sync"></i>
            </button>
        </div>
    @endif

    <div class="header-buttons__item">
        @include('wiki._locale_menu', [
            'availableLocales' => $page->availableLocales(),
            'displayLocale' => $displayLocale,
            'path' => $page->path,
        ])
    </div>
</div>
