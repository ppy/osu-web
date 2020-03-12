{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
