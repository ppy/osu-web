{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'backgroundImage' => $team->header()->url(),
        'links' => App\Http\Controllers\TeamsController::pageLinks('members.index', $team),
        'theme' => 'team',
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
                        <span>{{ osu_trans('teams.members.index.table.status') }}</span>
                        <span>{{ osu_trans('teams.members.index.table.joined_at') }}</span>
                        <span></span>
                    @foreach ($team->members as $member)
                        @php
                            $user = $member->userOrDeleted();
                        @endphp
                        <li class="team-members-manage__item">
                            <a
                                class="team-members-manage__username js-usercard"
                                data-user-id="{{ $user->getKey() }}"
                                href="{{ route('users.show', $user->getKey()) }}"
                            >
                                <span class="team-members-manage__avatar">
                                    <span
                                        class="avatar avatar--full avatar--guest"
                                        {!! background_image($user->user_avatar) !!}
                                    ></span>
                                </span>

                                {{ $user->username }}
                            </a>
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
                            <form
                                action="{{ route('teams.members.set-leader', compact('member', 'team')) }}"
                                class="u-contents"
                                data-turbo-confirm="{{ osu_trans(
                                    'teams.members.index.table.set_leader_confirm',
                                    ['user' => $user->username],
                                ) }}"
                                method="POST"
                            >
                                <button
                                    class="btn-osu-big btn-osu-big--rounded-small"
                                    {{ $member->user_id === $team->leader_id ? 'disabled' : '' }}
                                    title="{{ osu_trans('teams.members.index.table.set_leader') }}"
                                >
                                    <span class="fas fa-fw fa-user-cog"></span>
                                </button>
                            </form>
                            <form
                                action="{{ route('teams.members.destroy', compact('member', 'team')) }}"
                                class="u-contents"
                                data-confirm="{{ osu_trans(
                                    'teams.members.index.table.remove_confirm',
                                    ['user' => $user->username],
                                ) }}"
                                data-reload-on-success="1"
                                data-remote="1"
                                method="POST"
                            >
                                <input type="hidden" name="_method" value="DELETE" />
                                <button
                                    class="btn-osu-big btn-osu-big--rounded-small"
                                    {{ $member->user_id === $team->leader_id ? 'disabled' : '' }}
                                    title="{{ osu_trans('teams.members.index.table.remove') }}"
                                >
                                    <span class="fas fa-fw fa-times"></span>
                                </button>
                            </form>
                    @endforeach
                </ul>
            </div>

            <div class="page-extra">
                <h2 class="title title--page-extra-small title--page-extra-small-top">
                    {{ osu_trans('teams.members.index.applications.title') }}
                </h2>
                <p>
                    {{ osu_trans('teams.members.index.applications.empty_slots') }}:
                    @php
                        $emptySlots = $team->emptySlots();
                    @endphp
                    {{ i18n_number_format(max(0, $emptySlots)) }}
                    @if ($emptySlots < 0)
                        ({{ osu_trans_choice('teams.members.index.applications.empty_slots_overflow', -$emptySlots) }})
                    @endif
                </p>
                @if ($team->applications->isEmpty())
                    {{ osu_trans('teams.members.index.applications.empty') }}
                @else
                    <ul class="team-members-manage team-members-manage--applications">
                        <li class="team-members-manage__item team-members-manage__item--header">
                            <span></span>
                            <span>{{ osu_trans('teams.members.index.applications.created_at') }}</span>
                            <span></span>
                            <span></span>
                        @foreach ($team->applications as $application)
                            @php
                                $user = $application->user;
                            @endphp
                            @if ($user === null)
                                @continue
                            @endif
                            <li class="team-members-manage__item">
                                <a
                                    class="team-members-manage__username js-usercard"
                                    data-user-id="{{ $user->getKey() }}"
                                    href="{{ route('users.show', $user->getKey()) }}"
                                >
                                    <span class="team-members-manage__avatar">
                                        <span
                                            class="avatar avatar--full avatar--guest"
                                            {!! background_image($user->user_avatar) !!}
                                        ></span>
                                    </span>

                                    {{ $user->username }}
                                </a>
                                <span>
                                    {!! timeago($application->created_at) !!}
                                </span>
                                <span>
                                    <form
                                        action="{{ route('teams.applications.accept', compact('application', 'team')) }}"
                                        class="u-contents"
                                        data-confirm="{{ osu_trans(
                                            'teams.members.index.applications.accept_confirm',
                                            ['user' => $user->username],
                                        ) }}"
                                        data-reload-on-success="1"
                                        data-remote="1"
                                        method="POST"
                                    >
                                        <button class="btn-osu-big btn-osu-big--rounded-small">
                                            <span class="fas fa-fw fa-check"></span>
                                        </button>
                                    </form>
                                </span>
                                <span>
                                    <form
                                        action="{{ route('teams.applications.reject', compact('application', 'team')) }}"
                                        class="u-contents"
                                        data-confirm="{{ osu_trans(
                                            'teams.members.index.applications.reject_confirm',
                                            ['user' => $user->username],
                                        ) }}"
                                        data-reload-on-success="1"
                                        data-remote="1"
                                        method="POST"
                                    >
                                        <button class="btn-osu-big btn-osu-big--rounded-small">
                                            <span class="fas fa-fw fa-times"></span>
                                        </button>
                                    </form>
                                </span>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
