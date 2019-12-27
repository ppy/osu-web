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
