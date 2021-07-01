{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'links' => [['url' => route('contests.index'), 'title' => osu_trans('contest.index.nav_title')]],
        'linksBreadcrumb' => true,
        'theme' => 'contests',
    ]])

    <div class="osu-page osu-page--contests">
        <div class="contest-list">
            <div class="contest-list-legend">
                @foreach (['entry', 'voting', 'results'] as $state)
                    <div class="contest-list-legend__item contest-list-legend__item--{{$state}}">{{osu_trans("contest.states.$state")}}</div>
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
