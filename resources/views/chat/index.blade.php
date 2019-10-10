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
@extends('master', [
    'bodyAdditionalClasses' => 'osu-layout__no-scroll',
    'currentSection' => 'community',
    'legacyNav' => false,
    'title' => trans('chat.title'),
    'opghCategory' => "osu! » {{ trans('layout.menu.community._') }}",
])

@section("content")
    <div class="js-react--chat osu-layout osu-layout--full"></div>
@endsection

@section("script")
    @parent

    <script id="json-sendto" type="application/json">
        {!! json_encode($json) !!}
    </script>

    <script id="json-presence" type="application/json">
        {!! json_encode($presence) !!}
    </script>

    @include('layout._extra_js', ['src' => 'js/react/chat.js'])
@endsection
