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
    'current_section' => 'community',
    'current_action' => 'profile',
    'title' => trans('users.show.title', ['username' => $user->username]),
    'pageDescription' => trans('users.show.page_description', ['username' => $user->username])
])

@section("content")
    @if (Auth::user() && Auth::user()->isAdmin() && $user->isRestricted())
        <div class="osu-page">
            @include('objects._notification-banner', [
                'type' => 'warning',
                'title' => trans('admin.users.restricted-banner.title'),
                'message' => trans('admin.users.restricted-banner.message'),
            ])
        </div>
    @endif

    <div class="js-react--profile-page"></div>
    {{--
        this should content a server side react.js render which doesn't exist in hhvm
        because the only library for it, which is experimental, requires PHP extension
        which isn't supported by hhvm (v8js).
    --}}
@endsection

@section ("script")
    @parent

    <script data-turbolinks-eval="always">
        var postEditorToolbar = {!! json_encode(["html" => render_to_string('forum._post_toolbar')]) !!};
    </script>

    <script id="json-user" type="application/json">
        {!! json_encode($userArray) !!}
    </script>

    <script id="json-achievements" type="application/json">
        {!! json_encode($achievements) !!}
    </script>

    @include('layout._extra_js', ['src' => 'js/react/profile-page.js'])
@endsection
