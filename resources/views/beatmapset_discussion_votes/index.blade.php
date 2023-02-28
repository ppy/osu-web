{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

{{-- FIXME: move to user modding history --}}
@section('content')
    @include('layout._page_header_v4')
    <div class="osu-page osu-page--generic">
        <div class="beatmapset-activities">
            @if (isset($user))
                <h2>{{ osu_trans('users.beatmapset_activities.title', ['user' => $user->username]) }}</h2>
            @endif

            @foreach ($votes as $vote)
                @include('beatmapset_discussion_votes._item', compact('vote'))
            @endforeach

            @include('objects._pagination_v2', ['object' => $votes])
        </div>
    </div>
@endsection
