{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
