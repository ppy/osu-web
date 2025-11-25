{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'links' => [
            ['url' => route('contests.index'), 'title' => osu_trans('contest.index.nav_title')],
            ['url' => route('contests.show', $contestJson['id']), 'title' => $contestJson['name']],
            ['url' => route('contests.entries.judge-results', ['contest' => $contestJson['id'], 'contest_entry' => $entryJson['id']]), 'title' => $entryJson['title']],
        ],
        'linksBreadcrumb' => true,
        'theme' => 'contests',
    ]])

    <div class="osu-page">
        <div class="js-react" data-react="contest-judge-results"></div>
    </div>
@endsection

@section('script')
    @parent

    <script id="json-contest" type="application/json">
        {!! json_encode($contestJson) !!}
    </script>

    <script id="json-entry" type="application/json">
        {!! json_encode($entryJson) !!}
    </script>

    <script id="json-entries" type="application/json">
        {!! json_encode($entriesJson) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/contest-judge-results.js'])
@endsection
