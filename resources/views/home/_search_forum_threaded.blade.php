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
    @endphp
    <div class="search-result__entry">
        <div class="search-entry search-entry--threaded">
            <h1 class="search-entry__row search-entry__row--title">
                {{ $source['title'] }}
            </h1>
            @foreach ($innerHits as $innerHit)
                <div class="search-entry__row">
                    @php
                        if (isset($innerHit['highlight'])) {
                            $highlights = $innerHit['highlight']['post_preview'];
                        } else {
                            $highlights = [html_excerpt($innerHit['_source']['post_preview'])];
                        }

                        $post_url = post_url($innerHit['_source']['topic_id'], $innerHit['_source']['post_id']);
                    @endphp
                    <a class="search-entry search-entry--inner"
                       href="{{ $post_url }}"
                    >
                        @foreach ($highlights as $highlight)
                            <span>{!! $highlight !!}</span>
                        @endforeach
                    </a>
                </div>
            @endforeach
            <p class="search-entry__row search-entry__row--footer">
                {{ route('forum.topics.show', $source['topic_id']) }}
            </p>
        </div>
    </div>
@endforeach
