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
@extends('master', [
    'current_section' => 'community',
    'current_action' => 'contests',
    'title' => "Contest: {$contest->name}",
    'pageDescription' => strip_tags($contest->description),
    'body_additional_classes' => 'osu-layout--body-darker'
])

@section('content')
    @include('objects.css-override', ['mapping' => [
        '.osu-page-header-v2--contests' => $contest->header_url,
    ]])

    <div class="osu-layout__row">
        <div class="osu-page-header-v2 osu-page-header-v2--contests">
            <div class="osu-page-header-v2__overlay"></div>
            <div class="osu-page-header-v2__subtitle">Contest &raquo;</div>
            <div class="osu-page-header-v2__title">{{$contest->name}}</div>
        </div>
    </div>
    <div class="osu-layout__row osu-layout__row--page-contests">
        <div class="page-contents__content--contests">
            <div class="contest__description">{!! $contest->description !!}</div>
            @if ($contest->ends_at->isPast())
                <div class='contest__voting-ended'>{{trans('contest.over')}}</div>
            @endif
            @yield('contest-entries')
        </div>
    </div>
@endsection

@section('script')
  @parent
  <script id="json-contest" type="application/json">
    {!! json_encode(fractal_api_serialize_item($contest, new App\Transformers\ContestTransformer())) !!}
  </script>
  @yield('contest-javascript')
  <script src="{{ elixir("js/react/contest.js") }}" data-turbolinks-track></script>
@stop
