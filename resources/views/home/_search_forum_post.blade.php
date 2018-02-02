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

@foreach ($results as $index => $hit)
    @php
        $source = $hit['_source'];
        $innerHits = $results->innerHits($index);
        $firstPost = $results->innerHits($index, 'first_post');
        $firstPostUrl = route('forum.topics.show', $source['topic_id']);
    @endphp
    <div class="search-result__entry search-result__entry--threaded">
        <a class="search-entry" href="{{ $firstPostUrl }}">
            <h1 class="search-entry__row search-entry__row--title">
                {{ $source['search_content'] }}
            </h1>
            <div class="search-entry__row search-entry__row--excerpt">
                @foreach ($firstPost as $post)
                    <span>{!! html_excerpt($post['_source']['search_content']) !!}</span>
                @endforeach
            </div>
            <p class="search-entry__row search-entry__row--footer">
                {{ $firstPostUrl }}
            </p>
        </a>

        <div class="search-entry__row search-entry__row--inner">
            @foreach ($innerHits as $innerHit)
                @php
                    $highlights = es_highlight($innerHit, 'search_content');
                    $postUrl = post_url($innerHit['_source']['topic_id'], $innerHit['_source']['post_id']);
                @endphp

                <a class="search-entry search-entry--inner" href="{{ $postUrl }}">
                    <div class="search-entry__row search-entry__row--excerpt">
                        @foreach ($highlights as $highlight)
                            <span class="search-entry__highlight">{!! $highlight !!}</span>
                        @endforeach
                    </div>
                    <p class="search-entry__row search-entry__row--footer">
                        {{ $postUrl }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
@endforeach
