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
    @if ($contest->voting_ends_at !== null && $contest->voting_ends_at->isPast())
        <div class='contest__voting-notice'>{{trans('contest.voting.over')}}</div>
    @endif
    <div class='contest__accordian' id='contests-accordian'>
        @foreach ($contests as $c)
            <div class='panel contest__multi-group'>
                <a href="#{{$c->id}}" class='contest__multi-heading' data-toggle='collapse' data-parent='#contests-accordian' aria-expanded='false'>
                    <span>{!! $c->name !!}</span>
                    <i class="contest__section-toggle fa fa-fw fa-chevron-down"></i>
                </a>
                <div class='contest__multi-panel collapse' id="{{$c->id}}">
                    @if ($c->type == 'art')
                        <div class="js-react--contestArtList" data-src="contest-{{$contest->id}}"></div>
                    @else
                        <div class="js-react--contestList" data-src="contest-{{$contest->id}}"></div>
                    @endif
                    <script id="contest-{{$contest->id}}" type="application/json">
                        {!! $c->defaultJson(Auth::user()) !!}
                    </script>
                    @if ($c->type == 'beatmap' && $c->extra_options['beatmapset_dl'])
                        <div class='contest__buttons'>
                            <a class="btn-osu-big btn-osu-big--contest-download" href="{{$c->extra_options['beatmapset_dl']}}">
                                <div class="btn-osu-big__content">
                                    <div class="btn-osu-big__left"><span class="btn-osu-big__text-top">Download .osz</span></div>
                                    <span class="fa fa-download"></span>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
  @parent
  <script src="{{ elixir("js/react/contest-voting.js") }}" data-turbolinks-track></script>
@stop
