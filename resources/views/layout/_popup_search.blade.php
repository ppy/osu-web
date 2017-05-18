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
<div class="nav-popup js-nav-search--container">
    <div>
        <div class="js-nav-search--result hidden">
            {{-- shall be replaced by the thing--}}
        </div>
        <div class="js-nav-search--initial">
            {{ trans('layout.popup_search.initial') }}
        </div>
        <div class="js-nav-search--loading hidden">
            <span class="fa fa-spin fa-refresh"></span>
        </div>
        <div class="js-nav-search--fail hidden">
            <a href="#" class="js-nav-search--run-link">
                {{ trans('layout.popup_search.retry') }}
            </a>
        </div>
    </div>
    <div class="nav-popup__bar">
        <span class="bar u-section-bg"></span>
    </div>
</div>
