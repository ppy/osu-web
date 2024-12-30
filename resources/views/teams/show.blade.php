{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Transformers\UserCompactTransformer;

    $userTransformer = new UserCompactTransformer();
    $toJson = fn ($users) => json_collection($users, $userTransformer, UserCompactTransformer::CARD_INCLUDES);
    $teamMembers = array_map($toJson, $team->members->mapToGroups(fn ($member) => [
        $member->user_id === $team->leader_id ? 'leader' : 'member' => $member->userOrDeleted(),
    ])->all());
    $teamMembers['member'] ??= [];
    $teamMembers['leader'] ??= $toJson([$team->members()->make(['user_id' => $team->leader_id])->userOrDeleted()]);
    $headerUrl = $team->header()->url();

    $buttons = new Ds\Set();
    if (priv_check('TeamPart', $team)->can()) {
        $buttons->add('part');
    }
@endphp

@extends('master', [
    'titlePrepend' => $team->name,
])

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'theme' => 'team',
        'backgroundImage' => $headerUrl,
    ]])

    <div class="osu-page osu-page--generic-compact">
        <div class="profile-info profile-info--cover profile-info--team">
            <div
                class="profile-info__bg profile-info__bg--team"
                {!! background_image($headerUrl) !!}
            >
                @if (priv_check('TeamUpdate', $team)->can())
                    <div class="profile-page-cover-editor-button">
                        <a
                            class="btn-circle btn-circle--page-toggle"
                            data-tooltip-position="left center"
                            href="{{ route('teams.members.index', $team) }}"
                            title="{{ osu_trans('teams.members.index.title') }}"
                        >
                            <span class="fa fa-users"></span>
                        </a>

                        <a
                            class="btn-circle btn-circle--page-toggle"
                            data-tooltip-position="left center"
                            href="{{ route('teams.edit', $team) }}"
                            title="{{ osu_trans('teams.edit.title') }}"
                        >
                            <span class="fa fa-wrench"></span>
                        </a>
                    </div>
                @endif
            </div>
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
        @if (!$buttons->isEmpty())
            <div class="profile-detail-bar profile-detail-bar--team">
                @if ($buttons->contains('part'))
                    <form
                        action="{{ route('teams.part', ['team' => $team]) }}"
                        data-turbo-confirm="{{ osu_trans('common.confirmation') }}"
                        method="POST"
                    >
                        <button class="team-action-button team-action-button--part">
                            {{ osu_trans('teams.show.bar.part') }}
                        </button>
                    </form>
                @endif
            </div>
        @endif
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
                                    <div class="team-info-entry__title">{{ osu_trans('teams.show.info.website') }}</div>
                                    <div class="team-info-entry__value">
                                        <span class="u-ellipsis-overflow">
                                            <a href="{{ $team->url }}">{{ $team->url }}</a>
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <h2 class="title title--page-extra-small title--page-extra-small-top">
                            {{ osu_trans('teams.show.sections.members') }}
                        </h2>
                        <div class="team-summary__members">
                            <div class="team-members team-members--owner">
                                <div class="team-members__meta">
                                    {{ osu_trans('teams.show.members.owner') }}
                                </div>
                                <div
                                    class="js-react--user-card u-contents"
                                    data-user="{{ json_encode($teamMembers['leader'][0]) }}"
                                ></div>
                            </div>

                            <div class="team-members">
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

                    <div class="team-summary__sidebar team-summary__sidebar--separator"></div>

                    <div>
                        {!! $team->descriptionHtml() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
