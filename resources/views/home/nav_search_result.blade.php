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
    <div class="nav-search-result__title">
        {{ trans('home.search.users.title') }}
    </div>

    <div class="nav-search-result__results">
        @foreach ($users as $user)
            <div class="nav-search-result__result">
                <a class="user-quick" href="{{ route('users.show', $user->getKey()) }}">
                    <div class="user-quick__avatar">
                        <div class="avatar avatar--full" {!! background_image($user->user_avatar, false) !!}>
                        </div>
                    </div>

                    <div class="user-quick__name u-ellipsis-overflow">
                        {{ $user->username }}
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    @if ($users->count() < $counts['users'])
        <a
            href="{{ route('search', ['query' => Request::input('query')]) }}"
            class="nav-search-result__more"
        >
            {!! trans('home.search.users.more', [
                'count' => '<em class="nav-search-result__count">'.($counts['users'] - $users->count()).'</em>'
            ]) !!}
        </a>
    @endif

    <ul>
        @foreach ($beatmapsets as $beatmapset)
            <li>
                <a href="{{ route('beatmapsets.show', $beatmapset->getKey()) }}">
                    {{ $beatmapset->title }}
                </a>
            </li>
        @endforeach
    </ul>

    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="{{ post_url($post->topic_id, $post->getKey()) }}">
                    {{ $post->topic->topic_title }}
                </a>
            </li>
        @endforeach
    </ul>

    <ul>
        @foreach ($wikiPages as $page)
            <li>
                <a href="{{ wiki_url($page->path, $page->locale) }}">
                    {{ $page->page()['header']['title'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
