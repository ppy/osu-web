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
@extends('master', [
    'currentSection' => 'beatmaps',
    'currentAction' => 'artists',
    'title' => trans('artist.title'),
    'pageDescription' => trans('artist.page_description'),
])

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'links' => [[
            'title' => trans('layout.header.artists.index'),
            'url' => route('artists.index'),
        ]],
        'linksBreadcrumb' => true,
        'section' => trans('layout.header.artists._'),
        'subSection' => trans('layout.header.artists.index'),
        'theme' => 'artists',
    ]])
    <div class="osu-page osu-page--artists">
        <div class="page-contents page-contents--artist">
            <div class="page-contents__artist-left">
                <div class="artist__description artist__description--index">{!! trans('artist.index.description') !!}</div>
                <div class="artist__index">
                    @foreach ($artists as $artist)
                        <div class="artist__box{{$artist->visible ? '' : ' artist__box--hidden'}}">
                            <div class="artist__portrait-wrapper">
                                <a href="{{route('artists.show', $artist)}}" class="artist__portrait artist__portrait--index {{$artist->hasNewTracks() ? ' artist__portrait--new' : ''}}" style="{{$artist->cover_url ? 'background-image: url(' . $artist->cover_url . ')' : ''}}"></a>
                                @if($artist->label !== null)
                                    <a class="artist__label-overlay artist__label-overlay--index" href="{{$artist->label->website}}" style="background-image: url('{{$artist->label->icon_url}}')"></a>
                                @endif
                                @if($artist->hasNewTracks())
                                    <span class="artist__badge-wrapper">
                                        <span class="pill-badge pill-badge--yellow pill-badge--with-shadow">{{trans('common.badges.new')}}</span>
                                    </span>
                                @endif
                            </div>
                            <a href="{{route('artists.show', $artist)}}" class="artist__name">{{$artist->name}}</a>
                            <div class="artist__track-count">{{trans_choice('artist.songs.count', $artist->tracks_count)}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
