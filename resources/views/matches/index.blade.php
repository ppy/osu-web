{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => $match->name])

@section('content')
    <div class="js-react--mp-history"></div>
@endsection

@section("script")
    @parent
    <script id="json-events" type="application/json">
        {!! json_encode($eventsJson) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/mp-history.js'])
@endsection
