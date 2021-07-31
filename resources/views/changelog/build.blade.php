{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => "{$build->updateStream->pretty_name} {$build->version}",
])

@section('content')
    <div class="js-react--changelog-build osu-layout osu-layout--full"></div>

    <script id="json-build" type="application/json">
        {!! json_encode($buildJson) !!}
    </script>

    <script id="json-update-streams" type="application/json">
        {!! json_encode($updateStreams) !!}
    </script>

    <script id="json-chart-config" type="application/json">
        {!! json_encode($chartConfig) !!}
    </script>

    <script id="json-comments-build-{{ $build->getKey() }}" type="application/json">
        {!! json_encode($commentBundle->toArray()) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/react/changelog-build.js'])
@endsection
