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
    @if (count($users['data']) > 0)
        <div class="nav-search-result__title">
            {{ trans('home.search.user.title') }}
        </div>

        <div class="nav-search-result__results nav-search-result__results--horizontal">
            @foreach ($users['data'] as $entry)
                <div class="nav-search-result__result">
                    @include('home._search_user', compact('entry'))
                </div>
            @endforeach
        </div>

        @if (count($users['data']) < $users['total'])
            <a
                href="{{ route('search', ['query' => Request::input('query'), 'mode' => 'user']) }}"
                class="nav-search-result__more"
            >
                {!! trans('home.search.user.more', [
                    'count' =>
                        '<em class="nav-search-result__count">'.($users['total'] - count($users['data'])).'</em>'
                ]) !!}
            </a>
        @endif
    @endif

    @if (count($beatmapsets['data']) > 0)
        <div class="nav-search-result__title">
            {{ trans('home.search.beatmapset.title') }}
        </div>

        <div class="nav-search-result__results">
            @foreach ($beatmapsets['data'] as $beatmapset)
                <div class="nav-search-result__result">
                    @include('home._nav_search_entry', [
                        'url' => route('beatmapsets.show', $beatmapset->getKey()),
                        'title' => $beatmapset->title,
                        'modifier' => 'beatmapset',
                    ])
                </div>
            @endforeach
        </div>

        @if (count($beatmapsets['data']) < $beatmapsets['total'])
            <a
                href="{{ route('search', ['query' => Request::input('query'), 'mode' => 'beatmapset']) }}"
                class="nav-search-result__more"
            >
                {!! trans('home.search.beatmapset.more', [
                    'count' =>
                        '<em class="nav-search-result__count">'.($beatmapsets['total'] - count($beatmapsets['data'])).'</em>'
                ]) !!}
            </a>
        @endif
    @endif

    <div class="nav-search-result__link">
        @include('home._nav_search_entry', [
            'url' => route('search', ['query' => Request::input('query'), 'mode' => 'wiki_page']),
            'title' => trans('home.search.wiki_page.link'),
            'modifier' => 'extra',
        ])
    </div>

    <div class="nav-search-result__link">
        @include('home._nav_search_entry', [
            'url' => route('search', ['query' => Request::input('query'), 'mode' => 'forum_post']),
            'title' => trans('home.search.forum_post.link'),
            'modifier' => 'extra',
        ])
    </div>

    <div class="nav-search-result__link">
        @include('home._nav_search_entry', [
            'url' => route('search', ['query' => Request::input('query')]),
            'title' => trans('home.search.advanced_link'),
            'modifier' => 'extra',
        ])
    </div>
</div>
