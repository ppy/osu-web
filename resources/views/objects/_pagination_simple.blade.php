{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if ($object->currentPage() !== 1 || $object->hasMorePages())
    @php
        $currentPage = $object->currentPage();
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
                <a class="pagination-v2__link pagination-v2__link--link pagination-v2__link--quick" href="{{ $object->url($currentPage - 1) }}">
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
                    <a class="pagination-v2__link pagination-v2__link--link" href="{{ $object->url(1) }}">1</a>
                </li>
            @endif

            @if ($currentPage > 4)
                <li class="pagination-v2__item">
                    <span class="pagination-v2__link">...</span>
                </li>
            @endif

            @foreach(range(max($currentPage - 2, 1), ($object->hasMorePages() ? $currentPage + 1 : $currentPage)) as $page)
                <li class="pagination-v2__item">
                    @if ($page === $currentPage)
                        <span class="pagination-v2__link pagination-v2__link--active">{{ $page }}</span>
                    @else
                        <a class="pagination-v2__link pagination-v2__link--link" href="{{ $object->url($page) }}">{{ $page }}</a>
                    @endif
                </li>
            @endforeach

            @if ($object->hasMorePages())
                <li class="pagination-v2__item">
                    <span class="pagination-v2__link">...</span>
                </li>
            @endif
        </ul>

        <div class="pagination-v2__col">
            @if ($object->hasMorePages())
                <a class="pagination-v2__link pagination-v2__link--link pagination-v2__link--quick" href="{{ $object->url($currentPage + 1) }}">
                    <span class="hidden-xs">
                        {{ osu_trans('common.pagination.next') }}
                    </span>
                    <i class="fas fa-angle-right"></i>
                </a>
            @else
                <span class="pagination-v2__link pagination-v2__link--quick pagination-v2__link--disabled">
                    <span class="hidden-xs">
                        {{ osu_trans('common.pagination.next') }}
                    </span>
                    <i class="fas fa-angle-right"></i>
                </span>
            @endif
        </div>
    </nav>
@endif
