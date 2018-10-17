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
    'current_section' => 'home',
    'pageDescription' => 'chatterriffic'
])

@section("content")
    @include('home._user_header_default', [
        'title' => trans('home.user.header.welcome', ['username' => Auth::user()->username])
    ])

    <div class="osu-page osu-page--small osu-page--chat">
        <h2 class="messaging__title">{{trans('messages.title')}}</h2>
        <div class="js-react--messaging" style="flex: 1 0 auto; display: flex; height: 100%; border-top: 1px solid #555555;"></div>
    </div>
@endsection

@section("script")
    @parent

    <script id="json-sendto" type="application/json">
        {!! json_encode($json) !!}
    </script>

    <script id="json-presence" type="application/json">
        {!! json_encode($presence) !!}
    </script>

    @include('layout._extra_js', ['src' => 'js/react/messaging.js'])
@endsection
