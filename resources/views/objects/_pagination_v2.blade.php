{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
                        {{ osu_trans('common.pagination.previous') }}
                    </span>
                </span>
            @else
                <a class="pagination-v2__link pagination-v2__link--quick" href="{{ $object->url($currentPage - 1) }}">
                    <i class="fas fa-angle-left"></i>
                    <span class="hidden-xs">
                        {{ osu_trans('common.pagination.previous') }}
                    </span>
                </a>
            @endif
        </div>

        <ul class="pagination-v2__col pagination-v2__col--pages">
            {{-- decide if we're showing first page link separately --}}
            @if ($currentPage > 3)
                <li class="pagination-v2__item">
                    <a class="pagination-v2__link" href="{{ $object->url(1) }}">1</a>
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
                        <a class="pagination-v2__link" href="{{ $object->url($page) }}">{{ $page }}</a>
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
                    <a class="pagination-v2__link" href="{{ $object->url($object->lastPage()) }}">{{ $object->lastPage() }}</a>
                </li>
            @endif
        </ul>

        <div class="pagination-v2__col">
            @if ($currentPage >= $object->lastPage())
                <span class="pagination-v2__link pagination-v2__link--quick pagination-v2__link--disabled">
                    <span class="hidden-xs">
                        {{ osu_trans('common.pagination.next') }}
                    </span>
                    <i class="fas fa-angle-right"></i>
                </span>
            @else
                <a class="pagination-v2__link pagination-v2__link--quick" href="{{ $object->url($currentPage + 1) }}">
                    <span class="hidden-xs">
                        {{ osu_trans('common.pagination.next') }}
                    </span>
                    <i class="fas fa-angle-right"></i>
                </a>
            @endif
        </div>
    </nav>
@endif
