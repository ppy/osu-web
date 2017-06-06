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

@if ($object->lastPage() > 1)
    @php
        $currentPage = $object->currentPage();
        $maxPages = $object->lastPage();
        $range = min($maxPages-1, $num_shown ?? 8); // number of additional pages (i.e. excluding current page) to show at a time

        $pagesOnLeft = floor($range/2);

        // if current page will be left of the center
        if ($currentPage < $pagesOnLeft) {
          $leftStart = 1;

        // current page will be right of the center
        } elseif ($currentPage > ($maxPages - $pagesOnLeft)) {
          $leftStart = $maxPages - $range;

        // current page will be centered
        } else {
          $leftStart = $currentPage - $pagesOnLeft;
        }

        $leftStart = max(1, $leftStart);
        $rightEnd = $leftStart + $range;
    @endphp

    <div class="paginator" id="pagination">
        @include('objects._pagination_page', ['page' => 1, 'label' => '«'])
        @include('objects._pagination_page', ['page' => max(1, $currentPage - 1), 'label' => '‹'])

        @foreach(range($leftStart, $rightEnd) as $page)
            @include('objects._pagination_page', ['page' => $page, 'label' => $page, 'active' => ($page == $currentPage)])
        @endforeach

        @include('objects._pagination_page', ['page' => min($maxPages, $currentPage + 1), 'label' => '›'])
        @include('objects._pagination_page', ['page' => $maxPages, 'label' => '»'])
    </div>
@endif
