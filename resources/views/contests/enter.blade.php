{{--
    Copyright 2016 ppy Pty. Ltd.

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
    <div class="contest__description">{!! Markdown::convertToHtml($contest->description_enter) !!}</div>

    @if (!$contest->isSubmissionOpen())
        @if ($contest->entry_starts_at !== null && $contest->entry_starts_at->isPast())
            <div class='contest__voting-ended'>{{trans('contest.entry.over')}}</div>
        @else
            <div class='contest__voting-ended'>{{trans('contest.entry.preparation')}}</div>
        @endif
    @else
        @if (!Auth::check())
          <div class='contest__voting-ended'>{{trans('contest.entry.login_required')}}</div>
        @else
          <div class='js-react--userContestEntry'></div>
        @endif
    @endif
@endsection

@section('script')
  @parent
  <script id="json-contest" type="application/json">
    {!! $contestJson !!}
  </script>
  <script id="json-userEntries" type="application/json">
    {!! $userEntriesJson !!}
  </script>
  <script src="{{ elixir("js/react/contest-entry.js") }}" data-turbolinks-track></script>
@stop
