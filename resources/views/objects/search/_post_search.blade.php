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
@php
    $link = post_url($hit->source('topic_id'), $hit->source('post_id'));
    $highlights = $search->highlightsForHit($hit);
    $time = $hit->source('post_time');
    $user = $users->where('user_id', $hit->source('poster_id'))->first() ?? new App\Models\DeletedUser();
@endphp

<div class="search-entry">
    @include('objects.search._forum_post', compact('highlights', 'link', 'time', 'user'))
</div>
