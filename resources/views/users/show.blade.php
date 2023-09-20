{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

@php
    $userJson = $initialData['user'];
    $stats = $initialData['user']['statistics'];
    $globalRank = $stats['global_rank'] ?? null;
    $countryRank = $stats['country_rank'] ?? null;

    $rankDescriptions = [];
    if ($globalRank !== null) {
        $rankDescriptions[] = trans('users.show.rank.global', ['mode' => $currentMode]) . ': #' . i18n_number_format($globalRank);
    }

    if ($countryRank !== null) {
        $rankDescriptions[] = trans('users.show.rank.country', ['mode' => $currentMode]) . ': #' . i18n_number_format($countryRank);
    }
@endphp

@extends('master', [
    'canonicalUrl' => $user->url(),
    'titlePrepend' => blade_safe(str_replace(' ', '&nbsp;', e($user->username))),
    'pageDescription' => presence(implode(', ', $rankDescriptions)),
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
