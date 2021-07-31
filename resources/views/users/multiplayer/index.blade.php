{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => blade_safe(str_replace(' ', '&nbsp;', e($user->username))),
    'pageDescription' => page_description($user->username),
])

@section('content')
    @include('users._restricted_banner', compact('user'))

    <div class="js-react--user-multiplayer-index osu-layout osu-layout--full"></div>
@endsection

@section ("script")
    @parent

    <script id="json-user-multiplayer-index" type="application/json">
        {!! json_encode($json) !!}
    </script>

    <script id="json-user" type="application/json">
        {!! json_encode($jsonUser) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/react/user-multiplayer-index.js'])
@endsection
