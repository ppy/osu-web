{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $keys = [];

    foreach (['stream', 'from', 'to'] as $key) {
        if (isset($indexJson['search'][$key])) {
            if ($key === 'stream') {
                $value = $indexJson['builds'][0]['update_stream']['display_name'] ?? null;
            }

            if (!isset($value)) {
                $value = $indexJson['search'][$key];
            }

            $keys[$key] = $value;
        }
    }

    $title = trans('changelog.index.page_title._'.implode('_', array_keys($keys)), $keys);
@endphp
@extends('master', [
    'legacyNav' => false,
    'title' => $title,
])

@section('content')
    <div class="js-react--changelog-index osu-layout osu-layout--full"></div>

    <script id="json-index" type="application/json">
        {!! json_encode($indexJson) !!}
    </script>

    <script id="json-update-streams" type="application/json">
        {!! json_encode($updateStreams) !!}
    </script>

    <script id="json-chart-config" type="application/json">
        {!! json_encode($chartConfig) !!}
    </script>

    @include('layout._extra_js', ['src' => 'js/react/changelog-index.js'])
@endsection
