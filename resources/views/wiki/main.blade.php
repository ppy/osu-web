{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $displayLocale = $page->requestedLocale;
@endphp
@extends('wiki.layout')

@section('content')
    @component('layout._page_header_v4', ['params' => [
        'links' => [[
            'title' => osu_trans('layout.header.help.index', [], $displayLocale),
            'url' => wiki_url('Main_page', $displayLocale),
        ]],
        'linksBreadcrumb' => true,
        'theme' => 'help',
    ]])
        @slot('linksAppend')
            @include('wiki._actions')
        @endslot
    @endcomponent

    <div class="osu-page osu-page--wiki osu-page--wiki-main">
        @include('wiki._notice')

        <div
            class="js-react"
            data-react="wiki-search"
            data-props="{{ json_encode([
                'locale' => $displayLocale,
                'placeholder' => osu_trans('common.input.search', [], $displayLocale),
            ]) }}"></div>

        <div class="wiki-main-page">
            {!! $page->get()["output"] !!}
        </div>
    </div>
@endsection
