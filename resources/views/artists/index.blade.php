{{--
    Copyright 2016 ppy Pty. Ltd.

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
@extends("master", [
    'current_section' => 'beatmaps',
    'current_action' => 'artists',
    'title' => trans('artist.title'),
    'pageDescription' => trans('artist.page_description'),
    'body_additional_classes' => 'osu-layout--body-darker'
])

@section("content")
    <div class="osu-layout__row">
        <div class="osu-page-header-v2 osu-page-header-v2--featured-artists">
            <div class="osu-page-header-v2__overlay"></div>
            <div class="osu-page-header-v2__subtitle osu-page-header-v2__subtitle--artist">{{trans('artist.beatmaps._')}} &raquo;</div>
            <div class="osu-page-header-v2__title">{{trans('artist.title')}}</div>
        </div>
    </div>
    <div class="osu-layout__row osu-layout__row--page-artist">
        <div class="page-contents page-contents--artist">
            <div class="page-contents__content--artist-left">
                <div class="artist__description artist__description--index">{!! trans('artist.index.description') !!}</div>
                <div class="artist__index">
                    @foreach ($artists as $artist)
                        <div class="artist__box">
                            <div class="artist__portrait-wrapper artist__portrait-wrapper--index">
                                <a href="{{route('artist.show', ['id' => $artist->id])}}" class="artist__portrait artist__portrait--index" style="{{$artist->cover_url ? 'background-image: url(' . $artist->cover_url . ')' : ''}}"></a>
                                @if($artist->label !== null)
                                    <a class="artist__label-overlay artist__label-overlay--index" href="{{$artist->label->website}}" style="background-image: url('{{$artist->label->icon_url}}')"></a>
                                @endif
                            </div>
                            <a href="{{route('artist.show', ['id' => $artist->id])}}" class="artist__name">{{$artist->name}}</a>
                            <div class="artist__track-count">{{trans_choice('artist.songs', $artist->tracks_count)}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
