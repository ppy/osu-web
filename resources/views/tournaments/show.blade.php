{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'currentSection' => 'community',
    'currentAction' => 'tournaments',
    'title' => $tournament->name,
])

@section('content')
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

            <div class="tournament__page">
                @if (count($links = $tournament->pageLinks()) > 0)
                    <div class="tournament__links">
                        @foreach ($links as $link)
                            <a
                                href="{{ $link['url'] }}"
                                class="btn-osu btn-osu-default btn-osu--tournament"
                            >{{ $link['title'] }}</a>
                        @endforeach
                    </div>
                @endif

                <div class="tournament__description">
                    @if ($tournament->signup_open->isFuture())
                        {{ trans('tournament.show.state.before_registration') }}
                    @elseif ($tournament->isRegistrationOpen())
                        {!! markdown($tournament->description) !!}

                        {{ trans('tournament.show.registration_ends', ['date' => i18n_date($tournament->signup_close)]) }}.
                    @elseif ($tournament->start_date->isFuture())
                        {{ trans('tournament.show.state.registration_closed') }}
                    @elseif ($tournament->isTournamentRunning())
                        {{ trans('tournament.show.state.running') }}
                    @else
                        {{ trans('tournament.show.state.ended') }}
                    @endif
                </div>
            </div>

            @if($tournament->isRegistrationOpen())
                <div class='tournament__countdown-timer'>
                    <div class='js-react--countdownTimer' data-deadline='{{json_time($tournament->signup_close)}}'></div>
                </div>

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
                                    class="btn-osu btn-osu-default btn-osu--giant"
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
