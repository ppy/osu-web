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
@extends('master')

@section('content')
    <div class="osu-layout__row osu-layout__row--page">
        <h2>{{$user->username}}</h2>

        <div>
            <h3>{{ trans('admin.beatmapset_activities.events.title_recent') }}</h3>
            @foreach ($events['items'] as $event)
                <p>
                    @include('admin.beatmapset_events._item', compact('event'))
                </p>
            @endforeach

            <a href="{{ route('admin.beatmapset-events.index', ['user' => $user->getKey()]) }}">
                {{ trans('common.buttons.show_more') }}
            </a>
        </div>

        <div>
            <h3>{{ trans('admin.beatmapset_activities.discussions.title_recent') }}</h3>
            @foreach ($discussions['items'] as $discussion)
                <p>
                    @include('admin.beatmap_discussions._item', compact('discussion'))
                </p>
            @endforeach

            <a href="{{ route('admin.beatmap-discussions.index', ['user' => $user->getKey()]) }}">
                {{ trans('common.buttons.show_more') }}
            </a>
        </div>

        <div>
            <h3>{{ trans('admin.beatmapset_activities.posts.title_recent') }}</h3>
            @foreach ($posts['items'] as $post)
                <p>
                    @include('admin.beatmap_discussion_posts._item', compact('post'))
                </p>
            @endforeach

            <a href="{{ route('admin.beatmap-discussion-posts.index', ['user' => $user->getKey()]) }}">
                {{ trans('common.buttons.show_more') }}
            </a>
        </div>

        <div>
            <h3>{{ trans('admin.beatmapset_activities.received_votes.title_recent') }}</h3>
            @foreach ($receivedVotes['items'] as $vote)
                <p>
                    @include('admin.beatmap_discussion_votes._item', compact('vote'))
                </p>
            @endforeach

            <a href="{{ route('admin.beatmap-discussion-votes.index', ['receiver' => $user->getKey()]) }}">
                {{ trans('common.buttons.show_more') }}
            </a>
        </div>

        <div>
            <h3>{{ trans('admin.beatmapset_activities.votes.title_recent') }}</h3>
            @foreach ($votes['items'] as $vote)
                <p>
                    @include('admin.beatmap_discussion_votes._item', compact('vote'))
                </p>
            @endforeach

            <a href="{{ route('admin.beatmap-discussion-votes.index', ['user' => $user->getKey()]) }}">
                {{ trans('common.buttons.show_more') }}
            </a>
        </div>
    </div>
@endsection
