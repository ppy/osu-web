{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $params = ['type' => 'playlists', 'list' => 'seasons'];
@endphp
@extends('rankings.index', [
    'hasFilter' => false,
    'hasMode' => false,
    'params' => $params,
    'titlePrepend' => osu_trans('rankings.playlists.seasons').': '.$season->name,
])

@if ($season->url !== null)
    @section('additionalHeaderLinks')
        <div class="header-buttons">
            <div class="header-buttons__item">
                <a
                    class="btn-osu-big btn-osu-big--rounded-thin"
                    href="{{ $season->url }}"
                    target="_blank"
                    title="{{ osu_trans('rankings.seasons.url') }}"
                >
                    <i class="fas fa-info"></i>
                </a>
            </div>
        </div>
    @endsection
@endif

@section('ranking-header')
    <div class="osu-page osu-page--ranking-info">
        @include('rankings._playlist_selector')
    </div>
    <div class="js-react--seasons-show u-contents"></div>
@endsection

@section('scores')
    @include('seasons._rankings_table', compact('divisions', 'scores'))
@endsection

@section ("script")
    @parent

    <script id="json-currentSeason" type="application/json">
        {!! json_encode($seasonJson) !!}
    </script>

    <script id="json-rooms" type="application/json">
        {!! json_encode($roomsJson) !!}
    </script>

    <script id="json-seasons" type="application/json">
        {!! json_encode($seasonsJson) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/seasons-show.js'])
@endsection
