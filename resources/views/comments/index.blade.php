{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@php
    $commentBundleJson = $commentBundle->toArray();

    $links = [
        [
            'title' => osu_trans('comments.index.nav_title'),
            'url' => route('comments.index'),
        ],
    ];

    $userJson = $commentBundleJson['user'] ?? null;
    if ($userJson !== null) {
        $links[] = [
            'title' => $userJson['username'],
            'url' => route('users.show', ['user' => $userJson['id']]),
        ];
        $links[] = [
            'title' => osu_trans('comments.index.nav_comments'),
            'url' => route('comments.index', ['user_id' => $userJson['id']]),
        ];
    }
@endphp

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'links' => $links,
        'linksBreadcrumb' => true,
        'theme' => 'comments',
    ]])
    <div class="osu-page osu-page--comments">
        <div class="js-react u-contents" data-react="comments-index"></div>

        @include('objects._pagination_v2', ['object' => $commentPagination])
    </div>

    <script id="json-index" type="application/json">
        {!! json_encode($commentBundleJson) !!}
    </script>
    @include('layout._react_js', ['src' => 'js/comments-index.js'])
@endsection
