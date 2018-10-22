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


<div class="js-pinned-header-sticky sticky-header js-sync-height--reference"
     data-sync-height-target="sticky-header"
     data-visibility="hidden"
     data-visibility-animation="none"
>
    <div class="osu-page">
        {{-- Workaround to remove empty block with padding --}}
        {{-- TODO: Need a better way to handle this while keeps the padding in the container element --}}
        @if (View::hasSection('sticky-header-breadcrumbs') || View::hasSection('sticky-header-content'))
            <div class="sticky-header__body">
                <div class="js-sticky-header-breadcrumbs sticky-header__breadcrumbs">
                    @yield('sticky-header-breadcrumbs')
                </div>
                <div class="js-sticky-header-content sticky-header__content">
                    @yield('sticky-header-content')
                </div>
            </div>
        @endif
    </div>
</div>
