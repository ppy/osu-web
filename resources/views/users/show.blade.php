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
    'currentAction' => 'profile',
    'title' => trans('users.show.title', ['username' => $user->username]),
    'pageDescription' => trans('users.show.page_description', ['username' => $user->username]),
])

@section('content')
    @if (Auth::user() && Auth::user()->isAdmin() && $user->isRestricted())
        @include('objects._notification_banner', [
            'type' => 'warning',
            'title' => trans('admin.users.restricted_banner.title'),
            'message' => trans('admin.users.restricted_banner.message'),
        ])
    @endif

    <div class="js-react--profile-page osu-layout osu-layout--full"></div>
@endsection

@section ("script")
    @parent

    <script data-turbolinks-eval="always">
        var postEditorToolbar = {!! json_encode(['html' => view('forum._post_toolbar')->render()]) !!};
    </script>

    @foreach ($jsonChunks as $name => $data)
        <script id="json-{{$name}}" type="application/json">
            {!! json_encode($data) !!}
        </script>
    @endforeach

    @include('layout._extra_js', ['src' => 'js/react/profile-page.js'])
@endsection
