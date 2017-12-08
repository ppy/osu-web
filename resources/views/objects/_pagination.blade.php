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
        $lastPage = $object->lastPage();
        // should be an odd number (i.e. left pages + current page + right pages)
        $pages ?? ($pages = 9);

        if ($lastPage <= $pages) {
            // less pages than desired
            $start = 1;
            $end = $lastPage;
        } else {
            $sidePages = ($pages - 1) / 2;

            if ($currentPage - $sidePages < 1) {
                // not enough pages on left, start from 1
                $start = 1;
                $end = $pages;
            } elseif ($currentPage + $sidePages > $lastPage) {
                // not enough pages on right, end at $lastPage
                $end = $lastPage;
                $start = $lastPage - $pages + 1;
            } else {
                // standard case
                $start = $currentPage - $sidePages;
                $end = $currentPage + $sidePages;
            }
        }
    @endphp

    <div class="paginator {{ isset($modifier) ? "paginator--{$modifier}" : '' }}">
        @include('objects._pagination_page', ['page' => 1, 'label' => '«'])
        @include('objects._pagination_page', ['page' => max(1, $currentPage - 1), 'label' => '‹'])

        @foreach(range($start, $end) as $page)
            @include('objects._pagination_page', ['page' => $page, 'label' => $page, 'active' => ($page === $currentPage)])
        @endforeach

        @include('objects._pagination_page', ['page' => min($lastPage, $currentPage + 1), 'label' => '›'])
        @include('objects._pagination_page', ['page' => $lastPage, 'label' => '»'])
    </div>
@endif
