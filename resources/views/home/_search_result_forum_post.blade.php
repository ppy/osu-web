{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{{-- more code than template in this view :best: --}}
@php
    $users = $search->users()->select('user_id', 'username', 'user_avatar')->get()->keyBy('user_id');
    $topics = $search->topics()->with('forum')->get()->keyBy('topic_id');
    $skipTitle = $search->isTopicSpecificSearch();
@endphp

@foreach ($search->data() as $entry)
    @php
        // $entry should be of type App\Libraries\Elasticsearch\Hit
        $postUrl = post_url($entry->source('topic_id'), $entry->source('post_id'));
        $topic = $topics[$entry->source('topic_id')] ?? new App\Models\Forum\Topic();
        $user = $users[$entry->source('poster_id')] ?? new App\Models\DeletedUser();
    @endphp
    <div class="search-result-entry">
        <div class="search-entry">
            @include('objects.search._forum_post', [
                'user' => $user,
                'title' => $skipTitle ? null : $topic->topic_title,
                'highlights' => $search->highlightsForHit($entry),
                'link' => $postUrl,
                'time' => $entry->source('post_time'),
            ])
        </div>
    </div>
@endforeach
