{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@php
    $json = $commentBundle->toArray();
    $commentJson = $json['comments'][0];
@endphp

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'links' => [
            [
                'title' => osu_trans('comments.index.nav_title'),
                'url' => route('comments.index'),
            ],
            [
                'title' => osu_trans('comments.show.nav_title'),
                'url' => route('comments.show', ['comment' => $commentJson['id']]),
            ],
        ],
        'linksBreadcrumb' => true,
        'theme' => 'comments',
    ]])

    <div class="osu-page osu-page--comment">
        <div class="js-react--comments-show u-contents"></div>
    </div>

    <script id="json-show" type="application/json">
        {!! json_encode($json) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/comments-show.js'])
@endsection
