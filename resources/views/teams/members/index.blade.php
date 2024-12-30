{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'theme' => 'team',
        'backgroundImage' => $team->header()->url(),
    ]])

    <div class="osu-page osu-page--generic-compact">
        <div class="user-profile-pages user-profile-pages--no-tabs">
            <div class="page-extra">
                <h2 class="title title--page-extra-small title--page-extra-small-top">
                    {{ osu_trans('teams.members.index.table.title') }}
                </h2>
                <ul class="team-members-manage">
                    <li class="team-members-manage__item team-members-manage__item--header">
                        <span></span>
                        <span></span>
                        <span>{{ osu_trans('teams.members.index.table.status') }}</span>
                        <span>{{ osu_trans('teams.members.index.table.joined_at') }}</span>
                        <span></span>
                    @foreach ($team->members as $member)
                        @php
                            $user = $member->userOrDeleted();
                        @endphp
                        <li class="team-members-manage__item">
                            <span class="team-members-manage__avatar">
                                <span
                                    class="avatar avatar--full avatar--guest"
                                    {!! background_image($user->user_avatar) !!}
                                ></span>
                            </span>
                            <span>
                                {!! link_to_user($user, null, '', []) !!}
                            </span>
                            <span>
                                {{ osu_trans('teams.members.index.status.status_'.(int) $user->isActive()) }}
                                @if ($user->isOnline())
                                    <small>
                                        ({!! osu_trans('users.show.lastvisit_online') !!})
                                    </small>
                                @elseif (($lastvisit = $user->displayed_last_visit) !== null)
                                    <small>
                                        ({!! osu_trans('users.show.lastvisit', ['date' => timeago($lastvisit)]) !!})
                                    </small>
                                @endif
                            </span>
                            <span>
                                {!! timeago($member->created_at) !!}
                            </span>
                            <span>
                                <form
                                    action="{{ route('teams.members.destroy', compact('member', 'team')) }}"
                                    class="u-contents"
                                    data-confirm="{{ osu_trans('common.confirmation') }}"
                                    data-reload-on-success="1"
                                    data-remote="1"
                                    method="POST"
                                >
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button
                                        class="btn-osu-big btn-osu-big--rounded-small"
                                        {{ $member->user_id === $team->leader_id ? 'disabled' : '' }}
                                    >
                                        {{ osu_trans('teams.members.index.table.remove') }}
                                    </button>
                                </form>
                            </span>
                    @endforeach
                </ul>
            </div>

            <div class="page-extra">
                <div class="team-settings">
                    <div class="team-settings__item team-settings__item--buttons">
                        <div>
                            <a
                                class="btn-osu-big btn-osu-big--rounded-thin"
                                href="{{ route('teams.show', ['team' => $team]) }}"
                            >
                                {{ osu_trans('common.buttons.back') }}
                            </a>
                        </div>

                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
