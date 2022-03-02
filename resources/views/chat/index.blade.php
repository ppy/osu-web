{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'bodyAdditionalClasses' => 'osu-layout__no-scroll',
])

@section("content")
    <div class="js-react--chat osu-layout osu-layout--full"></div>
@endsection

@section("script")
    @parent

    <script id="json-chat-initial" type="application/json">
        {!! json_encode($json) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/chat.js'])
@endsection
