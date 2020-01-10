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
@extends('master')

{{-- FIXME: move to user modding history --}}
@section('content')
    @include('layout._page_header_v4', ['params' => [
        'section' => trans('layout.header.beatmapsets._'),
        'subSection' => trans('beatmap_discussion_posts.index.title'),
    ]])
    <div class="osu-page osu-page--generic">
        <div class="beatmapset-activities">
            @if (isset($user))
                <h2>{{ trans('users.beatmapset_activities.title', ['user' => $user->username]) }}</h2>
            @endif

            <div>
                @foreach ($posts as $post)
                    @include('beatmap_discussion_posts._item', compact('post'))
                @endforeach

                @include('objects._pagination_simple', ['object' => $posts])
            </div>
        </div>
    </div>
@endsection
