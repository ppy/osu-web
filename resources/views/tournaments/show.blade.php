{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $links = [
        [
            'title' => osu_trans('layout.header.tournaments.index'),
            'url' => route('tournaments.index'),
        ],
        [
            'title' => $tournament->name,
            'url' => route('tournaments.show', $tournament),
        ],
    ];
@endphp

@extends('master', ['titlePrepend' => $tournament->name])

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'links' => $links,
        'linksBreadcrumb' => true,
        'theme' => 'tournaments',
    ]])
    <style>
        :root { {{ css_var_2x('--tournament-header-banner', $tournament->header_banner) }} }
    </style>

    <div class="osu-page osu-page--info-bar">
        <div class="grid-items">
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ osu_trans('tournament.show.period.start') }}
                </div>
                <div class="counter-box__count">
                    {{ i18n_date($tournament->start_date) }}
                </div>
            </div>
            <div class="counter-box counter-box--info">
                <div class="counter-box__title">
                    {{ osu_trans('tournament.show.period.end') }}
                </div>
                <div class="counter-box__count">
                    {{ i18n_date($tournament->end_date) }}
                </div>
            </div>
        </div>
    </div>

    <div class="osu-page">
        <div class="tournament">
            <div class='tournament__banner'></div>

            <div class="tournament__page">
                @if (count($links = $tournament->pageLinks()) > 0)
                    <div class="tournament__links">
                        @foreach ($links as $link)
                            <a
                                href="{{ $link['url'] }}"
                                class="btn-osu-big btn-osu-big--tournament-info"
                            >{{ $link['title'] }}</a>
                        @endforeach
                    </div>
                @endif

                <div class="tournament__description">
                    @if ($tournament->signup_open->isFuture())
                        {{ osu_trans('tournament.show.state.before_registration') }}
                    @elseif ($tournament->isRegistrationOpen())
                        {!! markdown($tournament->description) !!}

                        <div class="tournament__description-md-extra">
                            {{ osu_trans('tournament.show.registration_ends', ['date' => i18n_date($tournament->signup_close)]) }}.
                        </div>
                    @elseif ($tournament->start_date->isFuture())
                        {{ osu_trans('tournament.show.state.registration_closed') }}
                    @elseif ($tournament->isTournamentRunning())
                        {{ osu_trans('tournament.show.state.running') }}
                    @else
                        {{ osu_trans('tournament.show.state.ended') }}
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
                            osu_trans('tournament.show.login_to_register', [
                                'login' => '<a href="#" class="js-user-link" title="'.osu_trans("users.anonymous.login_link").'">'.osu_trans("users.anonymous.login_text").'</a>'
                            ])
                        !!}</div>
                    @else
                        @if($tournament->isValidRank(Auth::user()))
                            @if($tournament->isSignedUp(Auth::user()))
                                <div>{!!osu_trans('tournament.show.entered')!!}</div>
                            @else
                                <div>{{osu_trans('tournament.show.not_yet_entered')}}</div>
                            @endif
                            @if($tournament->isSignedUp(Auth::user()))
                                <a
                                    href="{{route("tournaments.unregister", $tournament) }}"
                                    class="btn-osu-big btn-osu-big--tournament-register"
                                    data-method="post"
                                    data-remote="1"
                                >
                                    {{osu_trans('tournament.show.button.cancel')}}
                                </a>
                            @else
                                <a
                                    href="{{ route("tournaments.register", $tournament) }}"
                                    class="btn-osu-big btn-osu-big--tournament-register"
                                    data-method="post"
                                    data-remote="1"
                                >
                                    {{osu_trans('tournament.show.button.register')}}
                                </a>
                            @endif
                        @else
                            <div>{{osu_trans('tournament.show.rank_too_low')}}</div>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>
@stop
