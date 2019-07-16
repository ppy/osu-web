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
    'currentSection' => 'community',
    'currentAction' => 'contests',
    'title' => "Contest: {$contestMeta->name}",
    'pageDescription' => strip_tags(markdown($contestMeta->currentDescription())),
])

@section('content')
    @include('objects.css-override', ['mapping' => [
        '.osu-page-header-v2--contests' => $contestMeta->header_url,
    ]])

    <div class="osu-page">
        <div class="osu-page-header-v2 osu-page-header-v2--contests">
            <div class="osu-page-header-v2__overlay"></div>
            <div class="osu-page-header-v2__title">{{$contestMeta->name}}</div>
        </div>
    </div>
    <div class="osu-page osu-page--contest">
        <div class='contest'>
            @yield('contest-content')
        </div>
    </div>
@endsection
