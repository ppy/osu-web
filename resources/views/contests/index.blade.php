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
    'currentAction' => 'contests',
    'title' => "Contests",
])

@section('content')
    <div class="osu-layout__row">
        <div class="osu-page-header-v2 osu-page-header-v2--contests">
            <div class="osu-page-header-v2__overlay"></div>
            <div class="osu-page-header-v2__title">{{trans('contest.header.large')}}</div>
            <div class="osu-page-header-v2__subtitle">{{trans('contest.header.small')}}</div>
        </div>
    </div>
    <div class="osu-page osu-page--contests">
        <div class="contest-list">
            <div class="contest-list-legend">
                @foreach (['entry', 'voting', 'results'] as $state)
                    <div class="contest-list-legend__item contest-list-legend__item--{{$state}}">{{trans("contest.states.$state")}}</div>
                @endforeach
            </div>
            @foreach ($contests as $contest)
                <a href='{{route('contests.show', $contest->id)}}' class="contest-list-item contest-list-item--{{$contest->state()}}{{$contest->visible ? '' : ' contest-list-item--hidden'}}">
                    <div class='contest-list-item__image' style="background-image: url({{$contest->header_url}})"></div>
                    <div class='contest-list-item__container'>
                        <div class='contest-list-item__left-content'>
                            <div class='contest-list-item__name'>{{$contest->name}}</div>
                            <div class='contest-list-item__date'>{{$contest->currentPhaseDateRange()}}</div>
                        </div>
                        <div class='contest-list-item__right-content'>
                            <div class='contest-list-item__type'>{{$contest->type}}</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
