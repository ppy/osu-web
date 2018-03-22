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
<div class="nav-search-result">
    @foreach ($quickSearch->searches() as $mode => $search)
        @if ($search->total() > 0)
            <div class="nav-search-result__results-container">
                <div class="nav-search-result__title">
                    {{ trans("home.search.{$mode}.title") }}
                </div>

                @include("home._nav_search_result_{$mode}", compact('search'))

                @if (count($search->data()) < $search->total())
                    <a
                        href="{{ route('search', ['query' => request('query'), 'mode' => $mode]) }}"
                        class="nav-search-result__more"
                    >
                        {!! trans("home.search.{$mode}.more", [
                            'count' =>
                                '<em class="nav-search-result__count">'.($search->total() - count($search->data())).'</em>'
                        ]) !!}
                    </a>
                @endif
            </div>
        @endif
    @endforeach

    <div class="nav-search-result__results-container">
        @include('home._nav_search_entry', [
            'url' => route('search', ['query' => request('query'), 'mode' => 'wiki_page']),
            'title' => trans('home.search.wiki_page.link'),
            'modifier' => 'extra',
        ])
    </div>

    <div class="nav-search-result__results-container">
        @include('home._nav_search_entry', [
            'url' => route('search', ['query' => request('query'), 'mode' => 'forum_post']),
            'title' => trans('home.search.forum_post.link'),
            'modifier' => 'extra',
        ])
    </div>

    <div class="nav-search-result__results-container">
        @include('home._nav_search_entry', [
            'url' => route('search', ['query' => request('query')]),
            'title' => trans('home.search.advanced_link'),
            'modifier' => 'extra',
        ])
    </div>
</div>
