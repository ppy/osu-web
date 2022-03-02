{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => $groupJson['name']])

@section('content')
    <div class="js-react--groups-show"></div>
@endsection

@section("script")
    @parent

    <script id="json-group" type="application/json">
        {!! json_encode($groupJson) !!}
    </script>

    <script id="json-users" type="application/json">
        {!! json_encode($usersJson) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/groups-show.js'])
@endsection
