{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'bodyAdditionalClasses' => 'osu-layout__no-scroll',
    'currentSection' => 'community',
    'legacyNav' => false,
    'title' => trans('chat.title'),
])

@section("content")
    <div class="js-react--chat osu-layout osu-layout--full"></div>
@endsection

@section("script")
    @parent

    <script id="json-sendto" type="application/json">
        {!! json_encode($json) !!}
    </script>

    <script id="json-presence" type="application/json">
        {!! json_encode($presence) !!}
    </script>

    @include('layout._extra_js', ['src' => 'js/react/chat.js'])
@endsection
