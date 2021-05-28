{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

@extends('master')

@section('content')
    @component('layout._page_header_v4', ['params' => [
        'links' => [[
            'title' => trans('layout.header.help.index'),
            'url' => wiki_url('Main_Page', $page->requestedLocale),
        ]],
        'linksBreadcrumb' => true,
        'theme' => 'help',
    ]])
        @slot('navAppend')
            @include('wiki._actions')
        @endslot
    @endcomponent

    <div class="osu-page osu-page--wiki osu-page--wiki-main">
        @include('wiki._notice')

        <div class="js-react--wiki-search"></div>

        <div class="wiki-main-page">
            {!! $page->get()["output"] !!}
        </div>
    </div>
@endsection
