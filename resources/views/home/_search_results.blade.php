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
<div>
    @foreach ($search->all() as $mode => $page)
        <div class="search-result search-result--{{ $mode }}">
            @if (request('mode') !== $mode)
                <h2 class="search-result__row search-result__row--title">
                    @lang("home.search.{$mode}.title")
                </h2>
            @endif

            @if ($page->total() === 0)
                <div class="search-result__row search-result__row--notice">
                    @lang('home.search.empty_result')
                </div>
            @else
                <div class="search-result__row search-result__row--entries-container">
                    <div class="search-result__entries">
                        @php
                            // FIXME: Users for forum search; do something about this in cleanup branch
                            // $result enumeration should probably be done according to each blade.
                            if ($result instanceof App\Libraries\ForumSearch) {
                                $users = $result->users()->select('user_id', 'username', 'user_avatar')->get();
                            }
                        @endphp
                        @foreach ($page as $entry)
                            <div class="search-result__entry">
                                @include("home._search_{$mode}", compact('entry', 'users'))
                            </div>
                        @endforeach
                    </div>

                    <a
                        class="
                            search-result__more-button
                            {{ $search->mode === $mode ? 'search-result__more-button--hidden' : '' }}
                        "
                        href="{{ route('search', ['mode' => $mode, 'query' => $search->params['query']]) }}"
                    >
                        <span class="fa fa-angle-right"></span>
                    </a>
                </div>

                @if ($search->mode === $mode)
                    {{-- overLimit call needs fixing --}}
                    @if (!$page->hasMorePages())
                        <div class="search-result__row search-result__row--notice">
                            {{ trans("home.search.{$mode}.more_hidden", ['max' => config("osu.search.max.{$mode}")]) }}
                        </div>
                    @endif

                    <div class="search-result__row search-result__row--paginator">
                        @include('objects._pagination', ['object' => $page, 'modifier' => 'search'])
                    </div>
                @else
                    <a
                        class="search-result__row search-result__row--more"
                        href="{{ route('search', ['mode' => $mode, 'query' => $search->params['query']]) }}"
                    >
                        @lang("home.search.{$mode}.more_simple")
                    </a>
                @endif
            @endif
        </div>
    @endforeach
</div>
