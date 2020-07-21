{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $title = trans('scores.show.title', [
        'username' => $score->user->username,
        'title' => $score->beatmap->beatmapset->getDisplayTitle(auth()->user()),
        'version' => $score->beatmap->version,
    ]);
@endphp
@extends('master', [
    'titlePrepend' => $title,
])

@section('content')
    <div class="js-react--scores-show osu-layout osu-layout--full"></div>

    <script id="json-show" type="application/json">
        {!! json_encode($scoreJson) !!}
    </script>

    @include('layout._extra_js', ['src' => 'js/react/scores-show.js'])
@endsection
