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
    <div class="js-react u-contents" data-react="beatmap-discussions"></div>
@endsection

@section ("script")
    @parent

    @foreach ($initialData as $name => $data)
        <script id="json-{{ $name }}" type="application/json">
            {!! json_encode($data) !!}
        </script>
    @endforeach


    @include('beatmapsets._recommended_star_difficulty_all')
    @include('layout._react_js', ['src' => 'js/beatmap-discussions.js'])
@endsection
