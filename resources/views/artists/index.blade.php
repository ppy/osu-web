{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'currentSection' => 'beatmaps',
    'currentAction' => 'artists',
    'title' => trans('artist.title'),
    'pageDescription' => trans('artist.page_description'),
])

@section('content')
    <div class="osu-layout__row">
        <div class="osu-page-header-v2 osu-page-header-v2--featured-artists">
            <div class="osu-page-header-v2__overlay"></div>
            <div class="osu-page-header-v2__title">{{trans('artist.title')}}</div>
        </div>
    </div>
    <div class="osu-layout__row osu-layout__row--page-artist-index">
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
