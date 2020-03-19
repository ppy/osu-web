{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
