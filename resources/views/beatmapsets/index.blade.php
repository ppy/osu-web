{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $canAdvancedSearch = priv_check('BeatmapsetAdvancedSearch')->can();
@endphp
@extends('master', [
  'pageDescription' => osu_trans('beatmapsets.index.title'),
])

@section('content')
  <div class="js-react--beatmaps" data-advanced-search="{{ (int) $canAdvancedSearch }}"></div>
  {{--
    this should content a server side react.js render which doesn't exist in hhvm
    because the only library for it, which is experimental, requires PHP extension
    which isn't supported by hhvm (v8js).
  --}}
@endsection

{{-- empty sections so placeholders render for react to fill in --}}
@if ($canAdvancedSearch)
    @section('sticky-header-breadcrumbs')
    @endsection

    @section('sticky-header-content')
    @endsection
@endif


@section("script")
  @parent

  <script id="json-filters" type="application/json">
    {!! json_encode($filters) !!}
  </script>

  <script id="json-beatmaps" type="application/json">
    {!! json_encode($beatmaps) !!}
  </script>

  @include('layout._react_js', ['src' => 'js/beatmaps.js'])
@stop
