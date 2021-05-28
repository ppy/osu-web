{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => trans('follows.mapping.page_title')])

@section('content')
    <div class="js-react--follows-mapping osu-layout osu-layout--full"></div>

    <script id="json-follows-mapping" type="application/json">
        {!! json_encode($followsJson) !!}
    </script>

    @include('layout._extra_js', ['src' => 'js/react/follows-mapping.js'])
@endsection
