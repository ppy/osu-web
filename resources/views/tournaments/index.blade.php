{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'links' => [['title' => osu_trans('layout.header.tournaments.index'), 'url' => route('tournaments.index')]],
        'linksBreadcrumb' => true,
        'theme' => 'tournaments',
    ]])

    <div class="osu-page">
        <div class="tournament-list">
            @foreach($listing as $state => $tournaments)
                @if($tournaments->isEmpty())
                    @if($state === 'current')
                        <h1 class="tournament-list__heading">{{osu_trans("tournament.index.state.$state")}}</h1>
                        <p class="tournament-list__none-running">{{osu_trans('tournament.index.none_running')}}</p>
                    @endif
                @else
                    <h1 class="tournament-list__heading">{{osu_trans("tournament.index.state.$state")}}</h1>
                    <div class="tournament-list__group{{$state == 'previous' ? ' tournament-list__group--old' : ''}}">
                    @foreach($tournaments as $t)
                        <a href="{{ route('tournaments.show', $t) }}" class='tournament-list-item{{$state == 'previous' ? ' tournament-list-item--old' : ''}}'>
                            <div class='tournament-list-item__image-wrapper'>
                                <img class='tournament-list-item__image'
                                    src="{{$t->header_banner}}"
                                    srcSet="{{$t->header_banner}} 1x, {{retinaify($t->header_banner)}} 2x">
                            </div>
                            <div class='tournament-list-item__metadata'>
                                <div class='tournament-list-item__metadata-left'>
                                    <div class='tournament-list-item__tournament-date'>{{
                                        osu_trans('tournament.tournament_period', [
                                            'start' => i18n_date($t->start_date),
                                            'end' => i18n_date($t->end_date),
                                        ])
                                    }}</div>
                                    <div class='tournament-list-item__registration-date'>{{
                                        osu_trans('tournament.index.registration_period', [
                                            'start' => i18n_date($t->signup_open),
                                            'end' => i18n_date($t->signup_close)
                                        ])
                                    }}</div>
                                </div>
                                <div class='tournament-list-item__metadata-right'>
                                    <div class='tournament-list-item__registrations'>
                                        {{ i18n_number_format($t->registrations->count()) }}
                                        <i class="fas fa-fw fa-users" title="{{ osu_trans('tournament.index.item.registered') }}"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
