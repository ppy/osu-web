{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    <div class="js-react--comments-index osu-layout osu-layout--full"></div>

    {{-- temporary pagination to be used by react component above --}}
    <div class="hidden">
        <div class="js-comments-pagination">
            @include('objects._pagination_v2', ['object' => $commentPagination])
        </div>
    </div>

    <script id="json-index" type="application/json">
        {!! json_encode($commentBundle->toArray()) !!}
    </script>
    @include('layout._react_js', ['src' => 'js/comments-index.js'])
@endsection
