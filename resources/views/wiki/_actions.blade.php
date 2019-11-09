{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

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
                    data-url="{{ wiki_url($page->path) }}"
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
