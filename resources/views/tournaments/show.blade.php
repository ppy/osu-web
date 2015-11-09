{{--
    Copyright 2015 ppy Pty. Ltd.

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
@extends("master")

@section("content")
<div class="osu-layout__row osu-layout__row--page wiki-header">
    <div class="text">
        <h1>{{ $tournament->name }}</h1>
        <h2>{{ $tournament->start_date->toFormattedDateString() }} ~ {{ $tournament->end_date->toFormattedDateString() }}</h2>
    </div>
</div>

<div class='osu-layout__row osu-layout__row--page tournaments'>
    {!! Markdown::convertToHtml($tournament->description) !!}
</div>

@if($tournament->isRegistrationOpen())
<div class="osu-layout__row osu-layout__row--page">
    <h1>Registration</h1>

    @if (!Auth::user())
        <div>
        Please <a href="#" title="{{ trans("users.anonymous.login") }}" data-toggle="modal" data-target="#user-dropdown-modal">login</a> to view registration details!
        </div>
    @else
        <div>
            @if($tournament->isSignedUp(Auth::user()))
            <p>
            Your registration has been processed. Please note that this does <strong>not</strong> mean you are assigned to a team; further instructions will be sent to you via email closer to the tournament date. Please make sure your osu! account email address is valid.
            </p>
            @else
            <p>
            You have not yet submitted a registration for this tournament. Registrations close on <strong>{{ $tournament->signup_close->toFormattedDateString() }}</strong>.
            </p>
            @endif
        </div>

        @if($tournament->isValidRank(Auth::user()))
        <div class="big-button">
            @if($tournament->isSignedUp(Auth::user()))
            <a href="{{ route("tournaments.unregister", $tournament) }}" class="btn-osu btn-osu-danger" data-method="post" data-remote="1">Cancel Registration</a>
            @else
            <a href="{{ route("tournaments.register", $tournament) }}" class="btn-osu btn-osu-default" data-method="post" data-remote="1">Sign me up!</a>
            @endif
        </div>
        @else
        <div class='alert-inline alert-danger'>
            Sorry, you do not meet the rank requirements for this tournament!
        </div>
        @endif
    @endif
</div>
@endif

@stop
