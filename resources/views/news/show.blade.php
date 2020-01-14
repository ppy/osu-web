{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
@php
    $title = $post->title();
@endphp
@extends('master', [
    'titlePrepend' => $title,
    'canonicalUrl' => $post->url(),
    'pageDescription' => blade_safe($post->previewText()),
    'opengraph' => [
        'title' => $title,
        'section' => trans('layout.menu.home.news-show'),
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


    @include('layout._extra_js', ['src' => 'js/react/news-show.js'])
@endsection
