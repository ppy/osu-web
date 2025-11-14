{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'currentHue' => $user->user_style,
    'pageDescription' => page_description($user->username),
    'titlePrepend' => App\Libraries\Opengraph\UserOpengraph::escapeForTitle($user->username),
])

@section('content')
    @include('users._restricted_banner', compact('user'))

    <div class="js-react u-contents" data-react="user-multiplayer-index"></div>
@endsection

@section ("script")
    @parent

    <script id="json-user-multiplayer-index" type="application/json">
        {!! json_encode($json) !!}
    </script>

    <script id="json-user" type="application/json">
        {!! json_encode($jsonUser) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/user-multiplayer-index.js'])
@endsection
