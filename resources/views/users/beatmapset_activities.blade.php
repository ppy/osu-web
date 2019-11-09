{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $legacyNav = false;
@endphp
@extends('master', [
    'currentSection' => 'community',
    'currentAction' => 'profile',
    'title' => trans('users.show.title', ['username' => $user->username]),
    'pageDescription' => trans('users.show.page_description', ['username' => $user->username]),
    'legacyNav' => $legacyNav,
])

@section('content')
    @if (Auth::user() && Auth::user()->isAdmin() && $user->isRestricted())
        @include('objects._notification_banner', [
            'type' => 'warning',
            'title' => trans('admin.users.restricted_banner.title'),
            'message' => trans('admin.users.restricted_banner.message'),
            'legacyNav' => $legacyNav,
        ])
    @endif

    <div class="js-react--modding-profile osu-layout osu-layout--full"></div>
@endsection

@section ("script")
    @parent

    @foreach ($jsonChunks as $name => $data)
        <script id="json-{{$name}}" type="application/json">
            {!! json_encode($data) !!}
        </script>
    @endforeach

    @include('layout._extra_js', ['src' => 'js/react/modding-profile.js'])
@endsection
