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
    'title' => "Featured Artist: $artist->name",
    'pageDescription' => $artist->description,
    'canonicalUrl' => $artist->url(),
    'opengraph' => [
        'title' => $artist->name,
        'section' => trans('layout.menu.beatmaps.artists'),
        'image' => $artist->cover_url,
    ],
])

@section('content')
    @include('objects.css-override', ['mapping' => [
        '.osu-page-header-v2--artist' => $images['header_url'],
        '.artist__portrait' => $images['cover_url'],
        '.artist__label-overlay' => $artist->label ? $artist->label->icon_url : '',
    ]])

    <div class="osu-layout__row">
        <div class="osu-page-header-v2 osu-page-header-v2--artist">
            <div class="osu-page-header-v2__overlay"></div>
            <div class="osu-page-header-v2__title osu-page-header-v2__title--artist">{{$artist->name}}</div>
        </div>
    </div>
    <div class="osu-layout__row osu-layout__row--page-artist">
        <div class="page-contents page-contents--artist">
            <div class="page-contents__artist-left">
                @if (!$artist->visible)
                    <div class="artist__admin-note">{{ trans('artist.admin.hidden') }}</div>
                @endif
                <div class="artist__description">{!! markdown($artist->description) !!}</div>
                @if (count($albums) > 0)
                    <div class="artist__albums">
                        @foreach ($albums as $album)
                            <div class="artist-album">
                                <a class="fragment-target" name="album-{{$album['id']}}" id="album-{{$album['id']}}"></a>
                                <div class="artist-album__header">
                                    <div class="artist-album__header-overlay{{$album['is_new'] ? ' artist-album__header-overlay--new' : ''}}" style="background-image: url({{$album['cover_url']}});"></div>
                                    <img class="artist-album__cover" src="{{$album['cover_url']}}">
                                    <span class="artist-album__title">{{$album['title']}}</span>
                                    <span class="artist-album__spacer"></span>
                                    @if ($album['is_new'])
                                        <span class="pill-badge pill-badge--yellow pill-badge--with-shadow">{{trans('common.badges.new')}}</span>
                                    @endif
                                </div>
                                <div class="js-react--artistTracklist" data-src="album-json-{{$album['id']}}"></div>
                                <script id="album-json-{{$album['id']}}" type="application/json">
                                    {!! json_encode($album['tracks']) !!}
                                </script>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if (count($tracks) > 0)
                    <div class="artist-album">
                        <div class="artist-album__header">
                            <div class="artist-album__header-overlay" style="background-image: url({{$images['header_url']}});"></div>
                            <span class="artist-album__title">{{trans('artist.songs._')}}</span>
                        </div>
                        <div class="js-react--artistTracklist" data-src="singles-json-{{$artist->id}}"></div>
                        <script id="singles-json-{{$artist->id}}" type="application/json">
                            {!! json_encode($tracks) !!}
                        </script>
                    </div>
                @endif
            </div>
            <div class="page-contents__sidebar">
                <div class="artist__links-area">
                    <div class="artist__portrait">
                        @if($artist->label !== null)
                            <a class="artist__label-overlay" href="{{$artist->label->website}}"></a>
                        @endif
                    </div>
                    @foreach ($links as $link)
                        <a class='artist-link-button artist-link-button--{{$link['class']}}' href='{{$link['url']}}'>
                            <span class='artist-link-button__lightbar'></span>
                            <i class="fa-fw {{$link['icon']}}"></i>
                            <span class='artist-link-button__text'>{{$link['title']}}</span>
                            <i class='fas fa-fw fa-chevron-right artist-link-button__chevron'></i>
                        </a>
                    @endforeach
                </div>
                @if (count($albums) > 0)
                    <div class="artist__links-area artist__links-area--albums">
                        @foreach ($albums as $album)
                            <a class="artist-sidebar-album{{$album['is_new'] ? ' artist-sidebar-album--new' : ''}}" href="#album-{{$album['id']}}" data-turbolinks="false">
                                <div class="artist-sidebar-album__cover-wrapper">
                                    <div class="artist-sidebar-album__glow" style="background-image: url({{$album['cover_url']}});"></div>
                                    <img class="artist-sidebar-album__cover" src="{{$album['cover_url']}}">
                                    @if ($album['is_new'])
                                        <span class="artist__badge-wrapper">
                                            <span class="pill-badge pill-badge--yellow pill-badge--with-shadow">{{trans('common.badges.new')}}</span>
                                        </span>
                                    @endif
                                </div>
                                <div class="artist-sidebar-album__title">{{$album['title']}}</div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section("script")
  @parent

  @include('layout._extra_js', ['src' => 'js/react/artist-page.js'])
@stop
