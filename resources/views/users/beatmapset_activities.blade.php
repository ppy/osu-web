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

    <div class="js-react u-contents" data-react="modding-profile"></div>
@endsection

@section ("script")
    @parent

    <script id="json-bundle" type="application/json">
        {!! json_encode($jsonChunks) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/modding-profile.js'])
@endsection
