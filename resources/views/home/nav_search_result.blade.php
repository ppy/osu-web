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

<ul>
    @foreach ($users as $user)
        <li>
            <a href="{{ route('users.show', $user->getKey()) }}">
                {{ $user->username }}
            </a>
        </li>
    @endforeach
</ul>
