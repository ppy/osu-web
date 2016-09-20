{{--
    Copyright 2016 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General P;ublic License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends('contests.base')

@section('contest-content')
    <div class="contest__description">{!! Markdown::convertToHtml($contest->description_voting) !!}</div>

    @if ($contest->voting_ends_at->isPast())
        <div class='contest__voting-ended'>{{trans('contest.voting.over')}}</div>
    @endif

    @yield('contest-entries')
@endsection

@section('script')
  @parent
  <script id="json-contest" type="application/json">
    {!! $contestJson !!}
  </script>
  <script src="{{ elixir("js/react/contest.js") }}" data-turbolinks-track></script>
@stop