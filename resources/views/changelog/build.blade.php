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
@extends('master', [
    'title' => trans('changelog.build.title', ['version' => "{$build['update_stream']['display_name']} {$build['version']}"]),
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

    @include('layout._extra_js', ['src' => 'js/react/changelog-build.js'])
@endsection
