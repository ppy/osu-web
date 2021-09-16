{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => osu_trans('beatmaps.discussions.show.title', [
        'title' => $beatmapset->getDisplayTitle(auth()->user()),
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

    @include('beatmapsets._recommended_star_difficulty_all')
    @include('layout._react_js', ['src' => 'js/react/beatmap-discussions.js'])
@endsection
