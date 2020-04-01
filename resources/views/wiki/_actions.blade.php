{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
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
                data-url="{{ wiki_url($page->path) }}"
                data-method="PUT"
                title="{{ trans('wiki.show.edit.refresh') }}"
            >
                <i class="fas fa-sync"></i>
            </button>
        </div>
    @endif
</div>
