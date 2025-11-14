{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => $post->title(),
    'canonicalUrl' => $post->url(),
])

@section('content')
    <div class="js-react u-contents" data-react="news-show"></div>

    <script id="json-show" type="application/json">
        {!! json_encode($postJson) !!}
    </script>

    <script id="json-comments" type="application/json">
        {!! json_encode($commentBundle->toArray()) !!}
    </script>

    <script id="json-sidebar" type="application/json">
        {!! json_encode($sidebarMeta) !!}
    </script>

    <div class="js-news-sidebar-record"></div>

    @include('layout._react_js', ['src' => 'js/news-show.js'])
@endsection
