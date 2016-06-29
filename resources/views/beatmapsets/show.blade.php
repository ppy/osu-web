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
@extends("master", [
    'current_section' => 'beatmaps',
])

@section("content")
    <div class="js-react--beatmapset-page"></div>
    {{--
        this should content a server side react.js render which doesn't exist in hhvm
        because the only library for it, which is experimental, requires PHP extension
        which isn't supported by hhvm (v8js).
    --}}
@endsection

@section("script")
    @parent

    <script id="json-beatmapset" type="application/json">
        {!! json_encode($set) !!}
    </script>

    <script id="json-countries" type="application/json">
        {!! json_encode($countries) !!}
    </script>

    <script src="{{ absolute_url(elixir("js/react/beatmapset-page.js")) }}" data-turbolinks-track></script>
@endsection
