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

{{-- more code than template in this view :best: --}}
@php
    // $entry should be of type App\Libraries\Elasticsearch\Hit
    $innerHits = $entry->innerHits('posts');
    $firstPost = $entry->innerHits('first_post'); // instance of App\Libraries\Elasticsearch\SearchResponse
    $firstPostUrl = route('forum.topics.show', $entry->source('topic_id'));
    $excerpt = implode('', array_map(function ($post) {
        return html_excerpt($post->source('search_content'));
    }, iterator_to_array($firstPost)));

    // FIXME: this is obviously a terrible idea.
    $user = App\Models\User::lookup($entry->source('poster_id'), 'id') ?? App\Models\UserNotFound::instance();
@endphp
<div class="search-entry-thread">
    <div class="search-entry">
        @include('objects.search._forum_post', [
            'user' => $user,
            'title' => $entry->source('search_content'),
            'highlights' => $excerpt,
            'link' => $firstPostUrl,
            'time' => i18n_time(parse_time_to_carbon($entry->source('post_time'))),
        ])
    </div>

    @foreach ($innerHits as $innerHit)
        @php
            $postUrl = post_url($innerHit->source('topic_id'), $innerHit->source('post_id'));
            // FIXME: this is obviously a terrible idea.
            $user = App\Models\User::lookup($innerHit->source('poster_id'), 'id') ?? App\Models\UserNotFound::instance();
            $highlights = implode(
                ' ... ',
                $innerHit->highlights(
                    'search_content',
                    App\Libraries\ForumSearch::HIGHLIGHT_FRAGMENT_SIZE * 2
                )
            )
        @endphp

        <div class="search-entry-thread__sub-item">
            <div class="search-entry">
                @include('objects.search._forum_post', [
                    'user' => $user,
                    'title' => null,
                    'highlights' => $highlights,
                    'link' => $postUrl,
                    'time' => i18n_time(parse_time_to_carbon($innerHit->source('post_time'))),
                ])
            </div>
        </div>
    @endforeach
</div>
