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
@extends('master', [
    'current_section' => 'community',
    'current_action' => 'tournaments',
    'title' => $tournament->name,
    'body_additional_classes' => 'osu-layout--body-darker'
])

@section("content")
    @include('objects.css-override', ['mapping' => ['.tournament__banner' => $tournament->header_banner]])

    <div class="osu-layout__row">
        <div class="osu-page-header-v2 osu-page-header-v2--tournaments">
            <div class="osu-page-header-v2__overlay"></div>
            <div class="osu-page-header-v2__title">{{$tournament->name}}</div>
            <div class="osu-page-header-v2__subtitle">{{
                trans('tournament.tournament_period', [
                    'start' => i18n_date($tournament->start_date),
                    'end' => i18n_date($tournament->end_date)
                ])
            }}</div>
        </div>
    </div>

    <div class="osu-page osu-page--tournament">
        <div class="tournament">
            <div class='tournament__banner'></div>

            <div class='tournament__description'>
                {!! Markdown::convertToHtml($tournament->description) !!}
                {{trans('tournament.show.registration_ends', ['date' => i18n_date($tournament->signup_close)])}}.
            </div>
            @if($tournament->isRegistrationOpen())
                <div class='tournament__countdown-timer'>
                    <div class='js-react--countdownTimer' data-deadline='{{json_time($tournament->signup_close)}}'></div>
                </div>
            @endif

            @if($tournament->isRegistrationOpen())
                <div class="tournament__body">
                    @if (!Auth::user())
                        <div>{!!
                            trans('tournament.show.login_to_register', [
                                'login' => '<a href="#" class="js-user-link" title="'.trans("users.anonymous.login_link").'">'.trans("users.anonymous.login_text").'</a>'
                            ])
                        !!}</div>
                    @else
                        @if($tournament->isValidRank(Auth::user()))
                            @if($tournament->isSignedUp(Auth::user()))
                                <div>{!!trans('tournament.show.entered')!!}</div>
                            @else
                                <div>{{trans('tournament.show.not_yet_entered')}}</div>
                            @endif
                            @if($tournament->isSignedUp(Auth::user()))
                                <a
                                    href="{{route("tournaments.unregister", $tournament) }}"
                                    class="btn-osu btn-osu-danger btn-osu--giant"
                                    data-method="post"
                                    data-remote="1"
                                >
                                    {{trans('tournament.show.button.cancel')}}
                                </a>
                            @else
                                <a
                                    href="{{ route("tournaments.register", $tournament) }}"
                                    class="btn-osu btn-osu-default btn-osu--giant"
                                    data-method="post"
                                    data-remote="1"
                                >
                                    {{trans('tournament.show.button.register')}}
                                </a>
                            @endif
                        @else
                            <div>{{trans('tournament.show.rank_too_low')}}</div>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>
@stop
