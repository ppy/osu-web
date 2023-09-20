{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

@extends('master', [
    'canonicalUrl' => $user->url(),
    'titlePrepend' => blade_safe(str_replace(' ', '&nbsp;', e($user->username))),
    'pageDescription' => $pageDescription,
    'opengraph' => [
        'title' => trans('users.show.title', ['username' => $user->username]),
        'image' => $user->user_avatar,
    ]
])

@section('content')
    @include('users._restricted_banner', compact('user'))

    <div
        class="js-react--profile-page osu-layout osu-layout--full"
        data-initial-data="{{ json_encode($initialData) }}"
    ></div>
@endsection

@section ("script")
    @parent

    @include('layout._react_js', ['src' => 'js/profile-page.js'])
@endsection
