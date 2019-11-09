{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => trans('beatmaps.discussions.show.title', [
        'title' => $beatmapset->title,
        'mapper' => $beatmapset->user->username ?? '?',
    ]),
])

@section('content')
    <div class="js-react--beatmap-discussions osu-layout osu-layout--full"></div>
@endsection

@section ("script")
    @parent

    <script id="json-beatmapset-discussion" type="application/json">
        {!! json_encode($initialData) !!}
    </script>

    @include('layout._extra_js', ['src' => 'js/react/beatmap-discussions.js'])
@endsection
