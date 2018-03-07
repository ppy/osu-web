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

@php
    // $entry should be of type App\Libraries\Elasticsearch\Hit
    $innerHits = $entry->innerHits('posts');
    $firstPost = $entry->innerHits('first_post');
    $firstPostUrl = route('forum.topics.show', $entry->source('topic_id'));
@endphp
<div class="search-entry-thread">
    <div class="search-entry">
        <a class="search-forum-post" href="{{ $firstPostUrl }}">
            <div class="search-forum-post__avatar">
                {{ $entry->source('poster_id') }}
            </div>
            <div class="search-forum-post__content">
                <h1 class="search-entry__row search-entry__row--title">
                    {{ $entry->source('search_content') }}
                </h1>
                <div class="search-entry__row search-entry__row--excerpt">
                    @foreach ($firstPost as $post)
                        <span>{!! html_excerpt($post->source('search_content')) !!}</span>
                    @endforeach
                </div>
                <div class="search-entry__row search-entry__row--footer">
                    <span>posted by </span>
                    <span class="search-forum-post__username">username</span>
                    <span class="search-forum-post__link">{{ $firstPostUrl }}</span>
                    <span class="search-forum-post__time">{{ $entry->source('post_time') }}</span>
                </div>
            </div>
        </a>
    </div>

    @foreach ($innerHits as $innerHit)
        @php
            $postUrl = post_url($innerHit->source('topic_id'), $innerHit->source('post_id'));
        @endphp

        <div class="search-entry-thread__sub-item">
            <a class="search-forum-post" href="{{ $postUrl }}">
                <div class="search-forum-post__avatar">
                    {{ $innerHit->source('poster_id') }}
                </div>
                <div class="search-forum-post__content">
                    <div class="search-entry__row search-entry__row--excerpt">
                        <span class="search-entry__highlight">
                            {!!
                                implode(
                                    ' ... ',
                                    $innerHit->highlights(
                                        'search_content',
                                        App\Libraries\ForumSearch::HIGHLIGHT_FRAGMENT_SIZE * 2
                                    )
                                )
                            !!}
                        </span>
                    </div>
                    <div class="search-entry__row search-entry__row--footer">
                        <span>posted by </span>
                        <span class="search-forum-post__username">username</span>
                        <span class="search-forum-post__link">{{ $postUrl }}</span>
                        <span class="search-forum-post__time">{{ $innerHit->source('post_time') }}</span>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
