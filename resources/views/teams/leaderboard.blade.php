{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => $team->name,
])

@section('content')
    @component('layout._page_header_v4', ['params' => [
        'backgroundImage' => $team->header()->url(),
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
