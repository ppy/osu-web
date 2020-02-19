{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'section' => trans('layout.header.community._'),
        'subSection' => trans('layout.header.community.livestream'),
    ]])

    <div class="osu-page osu-page--description">
        {!! trans('livestreams.top-headers.description', [
            'link' => link_to(
                wiki_url('Guides/Live_Streaming_osu!'),
                trans('livestreams.top-headers.link'),
                ['class' => 'link link--default']
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
