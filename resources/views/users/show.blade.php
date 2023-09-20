{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

@php
    $userData = $jsonChunks["user"];
    $stats = $userData["statistics"];
    $globalRankLabel = trans('users.show.rank.global_simple');
    $globalRankValue = number_format($stats["global_rank"]);
    $countryRankLabel = trans('users.show.rank.country_simple');
    $countryRankValue = number_format($stats["country_rank"]);
@endphp

@extends('master', [
    'canonicalUrl' => $user->url(),
    'titlePrepend' => blade_safe(str_replace(' ', '&nbsp;', e($user->username))),
    'pageDescription' => "{$globalRankLabel}: #{$globalRankValue}\n{$countryRankLabel}: #{$countryRankValue}",
    'opengraph' => [
        'title' => trans('users.show.title', ["username" => $user->username]),
        'image' => $userData["avatar_url"]
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
