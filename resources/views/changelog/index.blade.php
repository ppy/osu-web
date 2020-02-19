{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
