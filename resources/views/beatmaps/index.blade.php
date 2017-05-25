{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
@extends("master", [
  'current_section' => 'beatmaps',
  'current_action' => 'index',
  'title' => trans('beatmapsets.index.title'),
  'pageDescription' => trans('beatmapsets.index.title'),
  'body_additional_classes' => 'osu-layout--body-ddd'
])

@section("content")
  <div class="js-react--beatmaps"></div>
  {{--
    this should content a server side react.js render which doesn't exist in hhvm
    because the only library for it, which is experimental, requires PHP extension
    which isn't supported by hhvm (v8js).
  --}}
@endsection

@section("script")
  @parent

  <script id="json-filters" type="application/json">
    {!! json_encode($filters) !!}
  </script>

  <script id="json-beatmaps" type="application/json">
    {!! json_encode($beatmaps) !!}
  </script>

  <script src="{{ elixir("js/react/beatmaps.js") }}" data-turbolinks-track="reload"></script>
@stop
