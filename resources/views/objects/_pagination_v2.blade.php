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

    <nav class="{{ class_with_modifiers('pagination-v2', $modifiers ?? []) }}">
        <div class="pagination-v2__col">
            @if ($currentPage === 1)
                <span class="pagination-v2__link pagination-v2__link--quick pagination-v2__link--disabled">
                    <i class="fas fa-angle-left"></i>
                    <span class="hidden-xs">
                        {{ trans('common.pagination.previous') }}
                    </span>
                </span>
            @else
                <a class="pagination-v2__link pagination-v2__link--link pagination-v2__link--quick" href="{{ $object->url($currentPage - 1) }}">
                    <i class="fas fa-angle-left"></i>
                    <span class="hidden-xs">
                        {{ trans('common.pagination.previous') }}
                    </span>
                </a>
            @endif
        </div>

        <ul class="pagination-v2__col pagination-v2__col--pages">
            {{-- decide if we're showing first page link separately --}}
            @if ($currentPage > 3)
                <li class="pagination-v2__item">
                    <a class="pagination-v2__link pagination-v2__link--link" href="{{ $object->url(1) }}">1</a>
                </li>
            @endif

            @if ($currentPage > 4)
                <li class="pagination-v2__item">
                    <span class="pagination-v2__link">...</span>
                </li>
            @endif

            @foreach(range(max($currentPage - 2, 1), min($currentPage + 2, $object->lastPage())) as $page)
                <li class="pagination-v2__item">
                    @if ($page === $currentPage)
                        <span class="pagination-v2__link pagination-v2__link--active">{{ $page }}</span>
                    @else
                        <a class="pagination-v2__link pagination-v2__link--link" href="{{ $object->url($page) }}">{{ $page }}</a>
                    @endif
                </li>
            @endforeach

            {{-- decide if we're showing last page link separately --}}
            {{-- first, see if `...` is needed --}}
            @if (($currentPage + 2) < ($object->lastPage() - 1))
                <li class="pagination-v2__item">
                    <span class="pagination-v2__link">...</span>
                </li>
            @endif

            {{-- see if the link is needed --}}
            @if (($currentPage + 2) < $object->lastPage())
                <li class="pagination-v2__item">
                    <a class="pagination-v2__link pagination-v2__link--link" href="{{ $object->url($object->lastPage()) }}">{{ $object->lastPage() }}</a>
                </li>
            @endif
        </ul>

        <div class="pagination-v2__col">
            @if ($currentPage >= $object->lastPage())
                <span class="pagination-v2__link pagination-v2__link--quick pagination-v2__link--disabled">
                    <span class="hidden-xs">
                        {{ trans('common.pagination.next') }}
                    </span>
                    <i class="fas fa-angle-right"></i>
                </span>
            @else
                <a class="pagination-v2__link pagination-v2__link--link pagination-v2__link--quick" href="{{ $object->url($currentPage + 1) }}">
                    <span class="hidden-xs">
                        {{ trans('common.pagination.next') }}
                    </span>
                    <i class="fas fa-angle-right"></i>
                </a>
            @endif
        </div>
    </nav>
@endif
