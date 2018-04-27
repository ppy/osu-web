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
    'pageDescription' => $beatmapset->toMetaDescription(),
    'titlePrepend' => "{$beatmapset->title} - {$beatmapset->artist}",
])

@section("content")
    <div class="js-react--beatmapset-page osu-layout osu-layout--full"></div>
@endsection

@section("script")
    @parent

    <script id="json-beatmapset" type="application/json">
        {!! json_encode($set) !!}
    </script>

    <script id="json-countries" type="application/json">
        {!! json_encode($countries) !!}
    </script>

    @include('layout._extra_js', ['src' => 'js/react/beatmapset-page.js'])
@endsection
