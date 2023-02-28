{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => ['theme' => 'livestreams']])

    <div class="osu-page osu-page--description">
        {!! osu_trans('livestreams.top-headers.description', [
            'link' => link_to(
                wiki_url('Guides/Live_Streaming_osu!'),
                osu_trans('livestreams.top-headers.link')
            ),
        ]) !!}
    </div>

    @if ($featuredStream !== null)
        <div class="osu-page">
            @include('livestreams._featured', compact('featuredStream'))
        </div>
    @endif

    <div class="osu-page">
        <div class="livestream-page">
            <div class="livestream-page__items">
                @foreach ($streams as $stream)
                    <div class="livestream-page__item">
                        @include('livestreams._livestream', compact('stream'))
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
