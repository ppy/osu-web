{{--
    Copyright 2015 ppy Pty. Ltd.

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
    <nav class="forum-pagination">
        <ul>
            {{-- decide if we're showing first page link separately --}}
            @if ($object->currentPage() > 5)
                <li>
                    <a class="u-forum--link" href="{{ $object->url(1) }}">1</a>
                </li>
            @endif

            @if ($object->currentPage() > 6)
                <li><span>...</span></li>
            @endif

            @foreach(range(max($object->currentPage() - 4, 1), min($object->currentPage() + 4, $object->lastPage())) as $page)
                @if ($page === $object->currentPage())
                    <li class="active">
                        <span>{{ $page }}</span>
                    </li>
                @else
                    <li>
                        <a class="u-forum--link" href="{{ $object->url($page) }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            {{-- decide if we're showing last page link separately --}}
            {{-- first, see if `...` is needed --}}
            @if (($object->currentPage() + 4) < ($object->lastPage() - 1))
                <li><span>...</span></li>
            @endif

            {{-- see if the link is needed --}}
            @if (($object->currentPage() + 4) < $object->lastPage())
                <li>
                    <a class="u-forum--link" href="{{ $object->url($object->lastPage()) }}">{{ $object->lastPage() }}</a>
                </li>
            @endif
        </ul>

        <ul class="forum-pagination-prevnext">
            <li>
                @if ($object->currentPage() === 1)
                    <span>
                        <i class="fa fa-angle-left"></i>
                        {{ trans("common.pagination.previous") }}
                    </span>
                @else
                    <a class="u-forum--link" href="{{ $object->url($object->currentPage() - 1) }}">
                        <i class="fa fa-angle-left"></i>
                        {{ trans("common.pagination.previous") }}
                    </a>
                @endif
            </li>
            <li>
                @if ($object->currentPage() === $object->lastPage())
                    <span>
                        {{ trans("common.pagination.next") }}
                        <i class="fa fa-angle-right"></i>
                    </span>
                @else
                    <a class="u-forum--link" href="{{ $object->url($object->currentPage() + 1) }}">
                        {{ trans("common.pagination.next") }}
                        <i class="fa fa-angle-right"></i>
                    </a>
                @endif
            </li>
        </ul>
    </nav>
@endif
