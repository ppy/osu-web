{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $username = $score->user === null || $score->user->isDeleted() ? osu_trans('users.deleted') : $score->user->username;
    $title = osu_trans('scores.show.title', [
        'username' => $username,
        'title' => $score->beatmap->beatmapset->getDisplayTitle(auth()->user()),
        'version' => $score->beatmap->version,
    ]);
@endphp
@extends('master', [
    'titlePrepend' => blade_safe(str_replace(' ', '&nbsp;', e($title))),
])

@section('content')
    <div class="js-react--scores-show osu-layout osu-layout--full"></div>

    <script id="json-show" type="application/json">
        {!! json_encode($scoreJson) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/react/scores-show.js'])
@endsection
