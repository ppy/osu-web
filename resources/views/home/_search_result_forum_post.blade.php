{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
    $users = $search->users()->select('user_id', 'username', 'user_avatar')->get();
    $firstPostsMap = $search->firstPostsMap();
@endphp

@foreach ($search->data() as $entry)
    @php
        // $entry should be of type App\Libraries\Elasticsearch\Hit
        $innerHits = $entry->innerHits('posts');
        $firstPostUrl = route('forum.topics.show', $entry->source('topic_id'));
        $excerpt = html_excerpt(optional($firstPostsMap[$entry->source('topic_id')] ?? null)->source('search_content'));

        $user = $users->where('user_id', $entry->source('poster_id'))->first() ?? new App\Models\DeletedUser();
    @endphp
    <div class="search-result-entry search-result-entry--threaded">
        <div class="search-entry">
            @include('objects.search._forum_post', [
                'user' => $user,
                'title' => $entry->source('search_content'),
                'highlights' => $excerpt,
                'link' => $firstPostUrl,
                'time' => $entry->source('post_time'),
            ])
        </div>

        @foreach ($innerHits as $innerHit)
            @php
                $postUrl = post_url($innerHit->source('topic_id'), $innerHit->source('post_id'));
                $user = $users->where('user_id', $innerHit->source('poster_id'))->first() ?? new App\Models\DeletedUser;
                $highlights = $search->highlightsForHit($innerHit);
            @endphp

            <div class="search-result-entry__sub-item">
                <div class="search-entry">
                    @include('objects.search._forum_post', [
                        'user' => $user,
                        'title' => null,
                        'highlights' => $highlights,
                        'link' => $postUrl,
                        'time' => $innerHit->source('post_time'),
                    ])
                </div>
            </div>
        @endforeach
    </div>
@endforeach
