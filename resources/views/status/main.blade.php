{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'blank' => true,
])
@section('content')
    {{--
        this should content a server side react.js render which doesn't exist in hhvm
        because the only library for it, which is experimental, requires PHP extension
        which isn't supported by hhvm (v8js).
    --}}
    <div class="js-react--status-page"></div>
@endsection
@section ("script")
    @parent

    <script data-turbolinks-eval="always">
        var osuStatus = {!! json_encode($data['status']) !!};
    </script>

    @include('layout._extra_js', ['src' => 'js/react/status-page.js'])
@endsection
