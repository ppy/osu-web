{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

{{-- FIXME: move to user modding history --}}
@section('content')
    <div class="osu-layout__row osu-layout__row--page">
        <div class="beatmapset-activities">
            @if (isset($user))
                <h2>{{ trans('users.beatmapset_activities.title', ['user' => $user->username]) }}</h2>
            @endif

            <div>
                <h3>{{ trans('beatmap_discussion_posts.index.title') }}</h3>
                @foreach ($posts as $post)
                    @include('beatmap_discussion_posts._item', compact('post'))
                @endforeach

                @include('objects._pagination_simple', ['object' => $posts])
            </div>
        </div>
    </div>
@endsection
