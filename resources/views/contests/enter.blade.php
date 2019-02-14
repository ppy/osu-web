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
    <div class="contest__description">{!! markdown($contestMeta->description_enter) !!}</div>
    @include('contests._countdown', ['deadline' => $contestMeta->currentPhaseEndDate()])
    @if (!Auth::check())
      <div class='contest__voting-notice contest__voting-notice--padding'>{{trans('contest.entry.login_required')}}</div>
    @else
      @if (Auth::user()->isSilenced() || Auth::user()->isRestricted())
        <div class='contest__voting-notice contest__voting-notice--padding'>{{trans('contest.entry.silenced_or_restricted')}}</div>
      @else
        @if (!$contestMeta->isSubmissionOpen())
          @if ($contestMeta->entry_starts_at !== null && $contestMeta->entry_starts_at->isPast())
            <div class='contest__voting-notice'>{{trans('contest.entry.over')}}</div>
            <div class='js-react--userContestEntry'></div>
          @else
            <div class='contest__voting-notice contest__voting-notice--padding'>{{trans('contest.entry.preparation')}}</div>
          @endif
        @else
          <div class='js-react--userContestEntry'></div>
        @endif
      @endif
    @endif
@endsection

@section('script')
  @parent
  <script id="json-contest" type="application/json">
    {!! $contest->defaultJson(Auth::user()) !!}
  </script>
  <script id="json-userEntries" type="application/json">
    {!! json_encode($contest->userEntries(Auth::user())) !!}
  </script>
  @include('layout._extra_js', ['src' => 'js/react/contest-entry.js'])
@stop
