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

@section('content')
    <div class="osu-layout__row osu-layout__row--page">
        <div class="beatmapset-activities">
            <h2>{{ trans('users.beatmapset_activities.title', ['user' => $user->username]) }}</h2>

            <div>
                <h3>{{ trans('users.beatmapset_activities.events.title_recent') }}</h3>
                @foreach ($events['items'] as $event)
                    @include('beatmapset_events._item', compact('event'))
                @endforeach

                <a href="{{ route('users.modding.events', ['user' => $user->getKey()]) }}">
                    {{ trans('common.buttons.show_more') }}
                </a>
            </div>

            <div>
                <h3>{{ trans('users.beatmapset_activities.discussions.title_recent') }}</h3>
                @foreach ($discussions['items'] as $discussion)
                    @include('beatmap_discussions._item', compact('discussion'))
                @endforeach

                <a href="{{ route('users.modding.discussions', ['user' => $user->getKey()]) }}">
                    {{ trans('common.buttons.show_more') }}
                </a>
            </div>

            <div>
                <h3>{{ trans('users.beatmapset_activities.posts.title_recent') }}</h3>
                @foreach ($posts['items'] as $post)
                    @include('beatmap_discussion_posts._item', compact('post'))
                @endforeach

                <a href="{{ route('users.modding.posts', ['user' => $user->getKey()]) }}">
                    {{ trans('common.buttons.show_more') }}
                </a>
            </div>

            <div>
                <h3>{{ trans('users.beatmapset_activities.votes_received.title_most') }}</h3>
                <div class="beatmapset-activities__user-upvote-list">
                    @foreach ($receivedVotes['items'] as $userVotes)
                        <div class="beatmapset-activities__user-upvote-panel">
                            @component('beatmapset_activities._user', ['user' => $userVotes[0]->user])
                                <span class="beatmap-discussion-post__user-text u-ellipsis-overflow">
                                    <a class="beatmapset-activities__vote-link"
                                    href="{{ route('users.modding.votes-given', $userVotes[0]->user) }}">
                                        {{$userVotes->sum('score') > 0 ? '+' : ''}}{{$userVotes->sum('score')}} ({{count($userVotes)}} votes)
                                    </a>
                                </span>
                            @endcomponent
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <h3>{{ trans('users.beatmapset_activities.votes_made.title_most') }}</h3>
                <div class="beatmapset-activities__user-upvote-list">
                    @foreach ($votes['items'] as $userVotes)
                        <div class="beatmapset-activities__user-upvote-panel">
                            @component('beatmapset_activities._user', ['user' => $userVotes[0]->beatmapDiscussion->user])
                                <span class="beatmap-discussion-post__user-text u-ellipsis-overflow">
                                    <a class="beatmapset-activities__vote-link"
                                    href="{{ route('users.modding.votes-received', $userVotes[0]->beatmapDiscussion->user) }}">
                                        {{$userVotes->sum('score') > 0 ? '+' : ''}}{{$userVotes->sum('score')}} ({{count($userVotes)}} votes)
                                    </a>
                                </span>
                            @endcomponent
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
