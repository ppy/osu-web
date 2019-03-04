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
@extends('contests.base')

@section('contest-content')
    <div class="contest__description">{!! markdown($contestMeta->description_voting) !!}</div>
    @include('contests._countdown', ['deadline' => $contestMeta->currentPhaseEndDate()])
    @if ($contestMeta->voting_ends_at !== null && $contestMeta->voting_ends_at->isPast())
        <div class='contest__voting-notice'>{{trans('contest.voting.over')}}</div>
    @endif
    @if (count($contests) === 1)
        @include('contests._voting-entrylist', ['contest' => $contests->first()])
    @else
        <div class='contest__accordion' id='contests-accordion'>
            @foreach ($contests as $contest)
                <div class='panel contest__group'>
                    <a href="#{{$contest->id}}" class='contest__group-heading' data-toggle='collapse' data-parent='#contests-accordion' aria-expanded='false'>
                        <span>{!! $contest->name !!}</span>
                        <i class="contest__section-toggle fas fa-fw fa-chevron-down"></i>
                    </a>
                    <div class='contest__multi-panel collapse' id="{{$contest->id}}">
                        @include('contests._voting-entrylist')
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

@section('script')
  @parent

  @include('layout._extra_js', ['src' => 'js/react/contest-voting.js'])
@stop
