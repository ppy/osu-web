{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="page-mode page-mode--search">
    @foreach ($allSearch->searches() as $mode => $search)
        <div class="page-mode__item">
            <a
                href="{{ route('search', ['mode' => $mode, 'query' => request('query')]) }}"
                class="page-mode-link {{ $mode === $allSearch->getMode() ? 'page-mode-link--is-active' : '' }}"
            >
                <span class="fake-bold" data-content="{{ trans("home.search.mode.{$mode}") }}">
                    {{ trans("home.search.mode.{$mode}") }}
                </span>

                @if ($allSearch->hasQuery() && $search !== null)
                    <span class="page-mode-link__badge">
                        @if ($search->count() < 100)
                            {{ $search->count() }}
                        @else
                            99+
                        @endif
                    </span>
                @endif

                <span class="page-mode-link__stripe u-forum--bg">
                </span>
            </a>
        </div>
    @endforeach
</div>
