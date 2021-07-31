{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    <div class="js-react--comments-show osu-layout osu-layout--full"></div>

    <script id="json-show" type="application/json">
        {!! json_encode($commentBundle->toArray()) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/react/comments-show.js'])
@endsection
