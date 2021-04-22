{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'canonicalUrl' => $user->url(),
    'titlePrepend' => blade_safe(str_replace(' ', '&nbsp;', e($user->username))),
    'pageDescription' => trans('users.show.rank_summary', [
      'username' => $user->username,
      'global' => $data["statistics"]["global_rank"],
      'local' => $data["statistics"]["country_rank"],
      'country' => $data["country"]["name"],
    ]),
    'opengraph' => [
        'title' => $user->username . "'s Profile",
        'image' =>  str_replace('http://localhost:8080', 'https://ffvyiglk.tunnelto.dev', $data["avatar_url"])
        // 'image' =>  json_encode($data),
    ]
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
