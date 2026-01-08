{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

@extends('master', [
    'canonicalUrl' => $user->url($mode),
    'currentHue' => $user->user_style,
    'titlePrepend' => App\Libraries\Opengraph\UserOpengraph::escapeForTitle($user->username),
])

@section('content')
    @include('users._restricted_banner', compact('user'))

    <div
        class="js-react u-contents"
        data-initial-data="{{ json_encode($initialData) }}"
        data-react="profile-page"
    ></div>
@endsection

@section ("script")
    @parent

    @include('layout._react_js', ['src' => 'js/profile-page.js'])
@endsection
