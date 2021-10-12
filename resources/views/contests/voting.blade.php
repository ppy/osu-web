{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('contests.base')

@section('contest-content')
    <div class="contest__description">{!! markdown($contestMeta->description_voting, 'contest') !!}</div>
    @include('contests._countdown', ['deadline' => $contestMeta->currentPhaseEndDate()])
    @if ($contestMeta->voting_ends_at !== null && $contestMeta->voting_ends_at->isPast())
        <div class='contest__voting-notice'>{{osu_trans('contest.voting.over')}}</div>
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

  @include('layout._react_js', ['src' => 'js/react/contest-voting.js'])
@stop
