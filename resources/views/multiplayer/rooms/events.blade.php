{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => $json['room']['name'],
])

@section('content')
    <div class="u-contents js-react--multiplayer-room-events"></div>
    <script id="json-events" type="application/json">
        {!! json_encode($json) !!}
    </script>
    @include('layout._react_js', ['src' => 'js/multiplayer-room-events.js'])
@endsection
