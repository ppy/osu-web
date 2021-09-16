{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('contests.base')

@section('contest-content')
    <div class="contest__description">{!! markdown($contestMeta->description_enter) !!}</div>
    @include('contests._countdown', ['deadline' => $contestMeta->currentPhaseEndDate()])
    @if (!Auth::check())
      <div class='contest__voting-notice contest__voting-notice--padding'>{{osu_trans('contest.entry.login_required')}}</div>
    @else
      @if (Auth::user()->isSilenced() || Auth::user()->isRestricted())
        <div class='contest__voting-notice contest__voting-notice--padding'>{{osu_trans('contest.entry.silenced_or_restricted')}}</div>
      @else
        @if (!$contestMeta->isSubmissionOpen())
          @if ($contestMeta->entry_starts_at !== null && $contestMeta->entry_starts_at->isPast())
            <div class='contest__voting-notice'>{{osu_trans('authorization.contest.entry.over')}}</div>
            <div class='js-react--userContestEntry'></div>
          @else
            <div class='contest__voting-notice contest__voting-notice--padding'>{{osu_trans('contest.entry.preparation')}}</div>
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
  @include('layout._react_js', ['src' => 'js/react/contest-entry.js'])
@stop
