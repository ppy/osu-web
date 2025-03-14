{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{{-- more code than template in this view :best: --}}
@php
    $posts = $search->posts()->select('post_id', 'icon_id')->get()->keyBy('post_id');
    $users = $search->users()->select('user_id', 'username', 'user_avatar')->get()->keyBy('user_id');
    $topics = $search->topics()->with('forum')->get()->keyBy('topic_id');
    $skipTitle = $search->isTopicSpecificSearch();
@endphp

@foreach ($search->data() as $entry)
    @php
        // $entry should be of type App\Libraries\Elasticsearch\Hit
        $post = $posts[$entry->source('post_id')];
        $postUrl = post_url($entry->source('topic_id'), $entry->source('post_id'));
        $postId = $entry->source('post_id');
        $topic = $topics[$entry->source('topic_id')] ?? new App\Models\Forum\Topic();
        $user = $users[$entry->source('poster_id')] ?? new App\Models\DeletedUser();

        if ($skipTitle) {
            $title = null;
        } else {
            $title = $search->getHighlights($entry, 'topic_title') ?? $topic->topic_title;
        }
    @endphp
    <div class="{{ class_with_modifiers('search-entry', ['deleted' => $entry->source('is_deleted')]) }}">
        @include('objects.search._forum_post', [
            'post' => $post,
            'user' => $user,
            'title' => $title,
            'link' => $postUrl,
            'excerpt' => $search->getHighlights($entry, 'search_content') ?? truncate($entry->source('search_content'), 100),
            'postId' => $postId,
            'time' => $entry->source('post_time'),
            'topic' => $topic,
        ])
    </div>
@endforeach
