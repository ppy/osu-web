{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => osu_trans('artist.tracks.index._'),
])

@section('content')
    <div
        class="js-react--artist-tracks-index"
        data-props="{{ json_encode(compact('availableGenres', 'data')) }}"
    ></div>

    @include('layout._react_js', ['src' => 'js/react/artist-tracks-index.js'])
@endsection
