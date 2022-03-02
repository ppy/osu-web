{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    <div
        class="js-react--news-index osu-layout osu-layout--full"
        data-props="{{ json_encode(['data' => $postsJson]) }}"
    ></div>

    <div class="js-news-sidebar-record"></div>

    @include('layout._react_js', ['src' => 'js/news-index.js'])
@endsection
