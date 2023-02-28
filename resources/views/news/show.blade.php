{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $title = $post->title();
@endphp
@extends('master', [
    'titlePrepend' => $title,
    'canonicalUrl' => $post->url(),
    'pageDescription' => blade_safe($post->previewText()),
    'opengraph' => [
        'title' => $title,
        'image' => $post->firstImage(true),
    ],
])

@section('content')
    <div class="js-react--news-show osu-layout osu-layout--full"></div>

    <script id="json-show" type="application/json">
        {!! json_encode($postJson) !!}
    </script>

    <script id="json-comments-news_post-{{ $post->getKey() }}" type="application/json">
        {!! json_encode($commentBundle->toArray()) !!}
    </script>

    <script id="json-sidebar" type="application/json">
        {!! json_encode($sidebarMeta) !!}
    </script>

    <div class="js-news-sidebar-record"></div>

    @include('layout._react_js', ['src' => 'js/news-show.js'])
@endsection
