{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

@extends('master')

@section('content')
    <div class="js-react" data-react="contest-judge-results" data-selected-id={{ $entry->getKey() }}></div>
@endsection

@section('script')
    @parent

    <script id="json-judge-results" type="application/json">
        {!! json_encode($json) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/contest-judge-results.js'])
@endsection
