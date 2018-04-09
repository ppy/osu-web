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
            <h3>{{ trans('users.beatmapset_activities.events.title_recent') }}</h3>
            @foreach ($events['items'] as $event)
                @include('beatmapset_events._item', compact('event'))
            @endforeach

            <a href="{{ route('beatmapsets.events.index', ['user' => $user->getKey()]) }}">
                {{ trans('common.buttons.show_more') }}
            </a>
        </div>

        <h3>{{ trans('users.beatmapset_activities.discussions.title_recent') }}</h3>
        @foreach ($discussions['items'] as $discussion)
            @include('beatmap_discussions._item', compact('discussion'))
        @endforeach

        <a href="{{ route('beatmap-discussions.index', ['user' => $user->getKey()]) }}">
            {{ trans('common.buttons.show_more') }}
        </a>

        <h3>{{ trans('users.beatmapset_activities.posts.title_recent') }}</h3>
        <div>
            @foreach ($posts['items'] as $post)
                @include('beatmap_discussion_posts._item', compact('post'))
            @endforeach

            <a href="{{ route('beatmap-discussion-posts.index', ['user' => $user->getKey()]) }}">
                {{ trans('common.buttons.show_more') }}
            </a>
        </div>

        <h3>{{ trans('users.beatmapset_activities.votes_received.title_most') }}</h3>
        <div class="beatmapset-activities__user-upvote-list">
            @foreach ($receivedVotes['items'] as $userVotes)
                <div class="beatmapset-activities__user-upvote-panel">
                    <div class="beatmap-discussion-post__avatar">
                        <a href="{{route('users.beatmapset-activities', $userVotes[0]->user->user_id)}}">
                            <div class="avatar avatar--full-rounded" style="background-image: url('{{$userVotes[0]->user->user_avatar}}');"></div>
                        </a>
                    </div>
                    <div class="beatmap-discussion-post__user">
                        <span class="beatmap-discussion-post__user-text u-ellipsis-overflow">{!! link_to_user($userVotes[0]->user) !!}</span>
                        <span class="beatmap-discussion-post__user-text u-ellipsis-overflow">
                            <a href="{{ route('beatmapsets.discussions.votes.index', ['user' => $userVotes[0]->user->user_id]) }}">
                                {{$userVotes->sum('score') > 0 ? '+' : ''}}{{$userVotes->sum('score')}} ({{count($userVotes)}} votes)
                            </a>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <h3>{{ trans('users.beatmapset_activities.votes_made.title_most') }}</h3>
        <div class="beatmapset-activities__user-upvote-list">
            @foreach ($votes['items'] as $userVotes)
                <div class="beatmapset-activities__user-upvote-panel">
                    <div class="beatmap-discussion-post__avatar">
                        <a href="{{route('users.beatmapset-activities', $userVotes[0]->beatmapDiscussion->user->user_id)}}">
                            <div class="avatar avatar--full-rounded" style="background-image: url('{{$userVotes[0]->beatmapDiscussion->user->user_avatar}}');"></div>
                        </a>
                    </div>
                    <div class="beatmap-discussion-post__user">
                        <span class="beatmap-discussion-post__user-text u-ellipsis-overflow">{!! link_to_user($userVotes[0]->beatmapDiscussion->user) !!}</span>
                        <a href="{{ route('beatmapsets.discussions.votes.index', ['receiver' => $userVotes[0]->beatmapDiscussion->user->user_id]) }}">
                            <span class="beatmap-discussion-post__user-text u-ellipsis-overflow">{{$userVotes->sum('score') > 0 ? '+' : ''}}{{$userVotes->sum('score')}} ({{count($userVotes)}} votes)</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
