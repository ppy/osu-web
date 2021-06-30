{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => blade_safe(str_replace(' ', '&nbsp;', e($user->username))),
    'pageDescription' => page_description($user->username),
])

@section('content')
    @if (Auth::user() && Auth::user()->isAdmin() && $user->isRestricted())
        @include('objects._notification_banner', [
            'type' => 'warning',
            'title' => osu_trans('admin.users.restricted_banner.title'),
            'message' => osu_trans('admin.users.restricted_banner.message'),
        ])
    @endif

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

    @include('layout._extra_js', ['src' => 'js/react/user-multiplayer-index.js'])
@endsection
