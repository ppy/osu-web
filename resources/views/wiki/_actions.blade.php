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
