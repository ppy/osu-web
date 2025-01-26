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

    $currentUser = Auth::user();
@endphp

@extends('master', [
    'titlePrepend' => $team->name,
])

@section('content')
    @component('layout._page_header_v4', ['params' => [
        'backgroundImage' => $headerUrl,
        'links' => App\Http\Controllers\TeamsController::pageLinks('leaderboard', $team),
        'theme' => 'team',
    ]])
        @slot('linksAppend')
            @include('objects._ruleset_selector', [
                'currentRuleset' => $ruleset,
                'urlFn' => fn ($r) => route('teams.leaderboard', ['team' => $team->getKey(), 'ruleset' => $r]),
            ])
        @endslot
    @endcomponent

    <div class="osu-page osu-page--generic-compact">
        <div class="user-profile-pages user-profile-pages--no-tabs">
            <div class="page-extra u-fancy-scrollbar">
                @include('teams._members_leaderboard')
            </div>
        </div>
    </div>
@endsection
