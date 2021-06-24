{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => trans('friends.title_compact')])

@section('content')
    <div class="js-react--friends-index osu-layout osu-layout--full"></div>
@endsection

@section("script")
    @parent

    <script id="json-users" type="application/json">
        {!! json_encode($usersJson) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/react/friends-index.js'])
@endsection
