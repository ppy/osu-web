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
            ['url' => route('contests.judge', $contestJson['id']), 'title' => osu_trans('contest.judge.nav_title')]
        ],
        'linksBreadcrumb' => true,
        'theme' => 'contests',
    ]])

    <div class="osu-page">
        <div class="js-react" data-react="contest-judge"></div>
    </div>
@endsection

@section('script')
    @parent

    <script id="json-contest" type="application/json">
        {!! json_encode($contestJson) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/contest-judge.js'])
@endsection
