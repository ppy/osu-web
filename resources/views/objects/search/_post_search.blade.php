{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $link = post_url($hit->source('topic_id'), $hit->source('post_id'));
    $highlights = $search->highlightsForHit($hit);
    $time = $hit->source('post_time');
    $user = $users->where('user_id', $hit->source('poster_id'))->first() ?? new App\Models\DeletedUser();
@endphp

<div class="search-entry">
    @include('objects.search._forum_post', compact('highlights', 'link', 'time', 'user'))
</div>
