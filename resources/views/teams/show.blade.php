{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Transformers\UserCompactTransformer;

    $userTransformer = new UserCompactTransformer();
    $toJson = fn ($users) => json_collection($users, $userTransformer, UserCompactTransformer::CARD_INCLUDES);
    $teamMembers = array_map($toJson, $team->members->sortBy('user.username')->mapToGroups(fn ($member) => [
        $member->user_id === $team->leader_id ? 'leader' : 'member' => $member->userOrDeleted(),
    ])->all());
    $teamMembers['member'] ??= [];
    $teamMembers['leader'] ??= $toJson([$team->members()->make(['user_id' => $team->leader_id])->userOrDeleted()]);
    $headerUrl = $team->header()->url();

    $currentUser = Auth::user();
@endphp

@extends('master', [
    'titlePrepend' => $team->name,
])

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'backgroundImage' => $headerUrl,
        'links' => App\Http\Controllers\TeamsController::pageLinks('show', $team),
        'theme' => 'team',
    ]])

    <div class="osu-page osu-page--generic-compact">
        <div class="profile-info profile-info--cover profile-info--team">
            <div
                class="profile-info__bg profile-info__bg--team"
                {!! background_image($headerUrl) !!}
            ></div>
            <div class="profile-info__details">
                <div class="profile-info__avatar">
                    @include('objects._flag_team', ['modifiers' => 'full', 'team' => $team])
                </div>
                <div class="profile-info__info">
                    <h1 class="profile-info__name">
                        {{ $team->name }}
                    </h1>
                    <div class="profile-info__flags">
                        <p class="profile-info__flag">
                            [{{ $team->short_name }}]
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-detail-bar profile-detail-bar--team">
            @if ($currentUser?->team?->getKey() === $team->getKey())
                @php
                    $partPriv = priv_check('TeamPart', $team);
                    $canPart = $partPriv->can();
                @endphp
                <form
                    action="{{ route('teams.part', ['team' => $team]) }}"
                    data-turbo-confirm="{{ osu_trans('common.confirmation') }}"
                    title="{{ $partPriv->message() }}"
                    method="POST"
                >
                    <button
                        class="{{ class_with_modifiers('team-action-button', 'part', ['disabled' => !$canPart]) }}"
                        @if (!$canPart)
                            disabled
                        @endif
                    >
                        {{ osu_trans('teams.show.bar.part') }}
                    </button>
                </form>
            @elseif ($currentUser?->teamApplication?->team_id === $team->getKey())
                <form
                    action="{{ route('teams.applications.destroy', ['team' => $team, 'application' => $currentUser->getKey()]) }}"
                    data-turbo-confirm="{{ osu_trans('common.confirmation') }}"
                    data-reload-on-success="1"
                    method="POST"
                >
                    <input type="hidden" name="_method" value="DELETE" />
                    <button
                        class="team-action-button team-action-button--join-cancel"
                    >
                        {{ osu_trans('teams.show.bar.join_cancel') }}
                    </button>
                </form>
            @else
                @php
                    $joinPriv = priv_check('TeamApplicationStore', $team);
                @endphp
                <form
                    action="{{ route('teams.applications.store', ['team' => $team]) }}"
                    data-confirm="{{ osu_trans('common.confirmation') }}"
                    data-reload-on-success="1"
                    data-remote="1"
                    method="POST"
                    title="{{ $joinPriv->message() }}"
                >
                    <button
                        class="team-action-button team-action-button--join js-login-required--click"
                        @if (!$joinPriv->can() && $currentUser !== null)
                            disabled
                        @endif
                    >
                        {{ osu_trans('teams.show.bar.join') }}
                    </button>
                </form>
            @endif
        </div>
        <div class="user-profile-pages user-profile-pages--no-tabs">
            <div class="page-extra u-fancy-scrollbar">
                <div class="team-summary">
                    <div class="team-summary__sidebar">
                        <h2 class="title title--page-extra-small title--page-extra-small-top">
                            {{ osu_trans('teams.show.sections.info') }}
                        </h2>
                        <div class="team-info-entries">
                            <div class="team-info-entry">
                                <div class="team-info-entry__title">{{ osu_trans('teams.show.info.created') }}</div>
                                <div class="team-info-entry__value">
                                    {{ i18n_date($team->created_at, pattern: 'year_month') }}
                                </div>
                            </div>
                            @if (present($team->url))
                                <div class="team-info-entry">
                                    <div class="team-info-entry__title">{{ osu_trans('teams.edit.settings.url') }}</div>
                                    <div class="team-info-entry__value u-ellipsis-overflow">
                                        <a href="{{ $team->url }}">{{ $team->url }}</a>
                                    </div>
                                </div>
                            @endif
                            <div class="team-info-entry">
                                <div class="team-info-entry__title">{{ osu_trans('teams.edit.settings.default_ruleset') }}</div>
                                <div class="team-info-entry__value">
                                    @php
                                        $rulesetName = App\Models\Beatmap::modeStr($team->default_ruleset_id);
                                    @endphp
                                    <span class="fal fa-extra-mode-{{ $rulesetName }}"></span>
                                    {{ osu_trans("beatmaps.mode.{$rulesetName}") }}
                                </div>
                            </div>
                            <div class="team-info-entry">
                                <div class="team-info-entry__title">{{ osu_trans('teams.edit.settings.application') }}</div>
                                <div class="team-info-entry__value">
                                    {{ osu_trans('teams.edit.settings.application_state.state_'.(string) $team->is_open) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="team-summary__sidebar team-summary__sidebar--separator"></div>

                    <div>
                        {!! $team->descriptionHtml() !!}
                    </div>
                </div>
            </div>

            <div class="page-extra">
                <h2 class="title title--page-extra-small title--page-extra-small-top">
                    {{ osu_trans('teams.show.sections.members') }}
                </h2>
                <div class="team-members">
                    <div class="team-members__type team-members__type--owner">
                        <div class="team-members__meta">
                            {{ osu_trans('teams.show.members.owner') }}
                        </div>
                        <div
                            class="js-react--user-card u-contents"
                            data-user="{{ json_encode($teamMembers['leader'][0]) }}"
                        ></div>
                    </div>

                    <div class="team-members__type">
                        <div class="team-members__meta">
                            <span>
                                {{ osu_trans('teams.show.members.members') }}
                            </span>
                            <span>
                                {{ i18n_number_format(count($teamMembers['member'])) }}
                            </span>
                        </div>
                        @foreach ($teamMembers['member'] as $memberJson)
                            <div
                                class="js-react--user-card u-contents"
                                data-user="{{ json_encode($memberJson) }}"
                            ></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
