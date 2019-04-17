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
@if ($object->lastPage() > 1)
    @php
        if ($object->currentPage() > $object->lastPage()) {
            $currentPage = $object->lastPage() + 1;
        } else {
            $currentPage = $object->currentPage();
        }
    @endphp

    <nav class="pagination-v0">
        <ul class="pagination-v0__row">
            {{-- decide if we're showing first page link separately --}}
            @if ($currentPage > 5)
                <li class="pagination-v0__item">
                    <a class="pagination-v0__link u-forum--link" href="{{ $object->url(1) }}">1</a>
                </li>
            @endif

            @if ($currentPage > 6)
                <li class="pagination-v0__item">
                    <span class="pagination-v0__link pagination-v0__link--separator">...</span>
                </li>
            @endif

            @foreach(range(max($currentPage - 4, 1), min($currentPage + 4, $object->lastPage())) as $page)
                @if ($page === $currentPage)
                    <li class="pagination-v0__item">
                        <span class="pagination-v0__link pagination-v0__link--active">{{ $page }}</span>
                    </li>
                @else
                    <li class="pagination-v0__item">
                        <a class="pagination-v0__link u-forum--link" href="{{ $object->url($page) }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            {{-- decide if we're showing last page link separately --}}
            {{-- first, see if `...` is needed --}}
            @if (($currentPage + 4) < ($object->lastPage() - 1))
                <li class="pagination-v0__item">
                    <span class="pagination-v0__link pagination-v0__link--separator">...</span>
                </li>
            @endif

            {{-- see if the link is needed --}}
            @if (($currentPage + 4) < $object->lastPage())
                <li class="pagination-v0__item">
                    <a class="pagination-v0__link u-forum--link" href="{{ $object->url($object->lastPage()) }}">{{ $object->lastPage() }}</a>
                </li>
            @endif
        </ul>

        <ul class="pagination-v0__row">
            <li class="pagination-v0__item">
                @if ($currentPage === 1)
                    <span class="pagination-v0__link pagination-v0__link--big">
                        <i class="fas fa-angle-left"></i>
                        {{ trans("common.pagination.previous") }}
                    </span>
                @else
                    <a class="pagination-v0__link pagination-v0__link--big u-forum--link" href="{{ $object->url($currentPage - 1) }}">
                        <i class="fas fa-angle-left"></i>
                        {{ trans("common.pagination.previous") }}
                    </a>
                @endif
            </li>
            <li class="pagination-v0__item">
                @if ($currentPage >= $object->lastPage())
                    <span class="pagination-v0__link pagination-v0__link--big">
                        {{ trans("common.pagination.next") }}
                        <i class="fas fa-angle-right"></i>
                    </span>
                @else
                    <a class="pagination-v0__link pagination-v0__link--big u-forum--link" href="{{ $object->url($currentPage + 1) }}">
                        {{ trans("common.pagination.next") }}
                        <i class="fas fa-angle-right"></i>
                    </a>
                @endif
            </li>
        </ul>
    </nav>
@endif
