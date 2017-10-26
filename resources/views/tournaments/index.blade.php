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
    'title' => trans('tournament.index.header.title'),
    'body_additional_classes' => 'osu-layout--body-darker'
])

@section("content")
    @php
        $cssMapping = [];
        foreach ($tournaments as $t) {
            $cssMapping[".tournament-list-item__image--".$t->tournament_id] = $t->header_banner;
        }
    @endphp
    @include('objects.css-override', ['mapping' => $cssMapping])

    <div class="osu-layout__row">
        <div class="osu-page-header-v2 osu-page-header-v2--tournaments">
            <div class="osu-page-header-v2__overlay"></div>
            <div class="osu-page-header-v2__title">{{trans('tournament.index.header.title')}}</div>
            <div class="osu-page-header-v2__subtitle">{{trans('tournament.index.header.subtitle')}}</div>
        </div>
    </div>

    <div class="osu-page osu-page--tournament">
        <div class="tournament-list">
            @if($tournaments->isEmpty())
                <h1 class="tournament-list__none-running">{{trans('tournament.index.none-running')}}</h1>
            @endif
            @foreach($tournaments as $t)
                <a href="{{ route('tournaments.show', $t) }}" class='tournament-list-item tournament-list-item--open'>
                    <div class='tournament-list-item__image-wrapper'>
                        <div class='tournament-list-item__image tournament-list-item__image--{{$t->tournament_id}}'></div>
                    </div>
                    <div class='tournament-list-item__metadata'>
                        <div class='tournament-list-item__metadata-left'>
                            <div class='tournament-list-item__tournament-date'>{{
                                trans('tournament.tournament-period', [
                                    'start' => i18n_date($t->start_date),
                                    'end' => i18n_date($t->end_date),
                                ])
                            }}</div>
                            <div class='tournament-list-item__registration-date'>{{
                                trans('tournament.index.registration-period', [
                                    'start' => i18n_date($t->signup_open),
                                    'end' => i18n_date($t->signup_close)
                                ])
                            }}</div>
                        </div>
                        <div class='tournament-list-item__metadata-right'>
                            <div class='tournament-list-item__registrations'>
                                {{number_format($t->registrations->count())}} <i class="fa fa-fw fa-users"></i>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
