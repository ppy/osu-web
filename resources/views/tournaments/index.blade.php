{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
    'currentSection' => 'community',
    'currentAction' => 'tournaments',
    'title' => trans('tournament.index.header.title'),
])

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'links' => [['title' => trans('layout.header.tournaments.index'), 'url' => route('tournaments.index')]],
        'linksBreadcrumb' => true,
        'section' => trans('layout.header.tournaments._'),
        'subSection' => trans('layout.header.tournaments.index'),
        'theme' => 'tournaments',
    ]])

    <div class="osu-page">
        <div class="tournament-list">
            @foreach($listing as $state => $tournaments)
                @if($tournaments->isEmpty())
                    @if($state === 'current')
                        <h1 class="tournament-list__heading">{{trans("tournament.index.state.$state")}}</h1>
                        <p class="tournament-list__none-running">{{trans('tournament.index.none_running')}}</p>
                    @endif
                @else
                    <h1 class="tournament-list__heading">{{trans("tournament.index.state.$state")}}</h1>
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
                                        trans('tournament.tournament_period', [
                                            'start' => i18n_date($t->start_date),
                                            'end' => i18n_date($t->end_date),
                                        ])
                                    }}</div>
                                    <div class='tournament-list-item__registration-date'>{{
                                        trans('tournament.index.registration_period', [
                                            'start' => i18n_date($t->signup_open),
                                            'end' => i18n_date($t->signup_close)
                                        ])
                                    }}</div>
                                </div>
                                <div class='tournament-list-item__metadata-right'>
                                    <div class='tournament-list-item__registrations'>
                                        {{ i18n_number_format($t->registrations->count()) }}
                                        <i class="fas fa-fw fa-users" title="{{ trans('tournament.index.item.registered') }}"></i>
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
