{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    <div class="js-react--group-history"></div>
@endsection

@section("script")
    @parent

    <script id="json-group-history" type="application/json">
        {!! json_encode($json) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/group-history.js'])
@endsection
