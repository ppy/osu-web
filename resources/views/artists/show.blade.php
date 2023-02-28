{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $headerLinks = [
        [
            'active' => true,
            'title' => osu_trans('layout.header.artists.index'),
            'url' => route('artists.index'),
        ],
        [
            'title' => osu_trans('artist.tracks.index._'),
            'url' => route('artists.tracks.index'),
        ],
    ];

    $artistJsonId = "json-artist-{$json['artist']['id']}";
@endphp

@extends('master', [
    'titlePrepend' => $artist->name,
    'pageDescription' => $artist->description,
    'canonicalUrl' => $artist->url(),
    'opengraph' => [
        'title' => $artist->name,
        'image' => $artist->cover_url,
    ],
])

@section('content')
    @include('objects.css-override', ['mapping' => [
        '.header-v4__bg' => $images['header_url'],
        '.artist__portrait' => $images['cover_url'],
        '.artist__label-overlay' => $artist->label ? $artist->label->icon_url : '',
    ]])

    @include('layout._page_header_v4', ['params' => [
        'links' => $headerLinks,
        'theme' => 'artist',
    ]])
    <div class="osu-page osu-page--artist">
        <div class="page-contents page-contents--artist">
            <div class="page-contents__artist-left">
                @if (!$artist->visible)
                    <div class="artist__admin-note">{{ osu_trans('artist.admin.hidden') }}</div>
                @endif
                <div class="artist__description">
                    <h1>{{ $artist->name }}</h1>

                    {!! markdown($artist->description) !!}
                </div>
                @if (count($json['albums']) > 0)
                    <div class="artist__albums">
                        @foreach ($json['albums'] as $album)
                            <div class="artist-album" id="album-{{ $album['id'] }}">
                                <div class="artist-album__header">
                                    <div class="artist-album__header-overlay{{$album['is_new'] ? ' artist-album__header-overlay--new' : ''}}" style="background-image: url('{{ $album['cover_url'] }}');"></div>
                                    <img class="artist-album__cover" src="{{$album['cover_url']}}">
                                    <span class="artist-album__title">{{$album['title']}}</span>
                                    @if ($album['is_new'])
                                        <span class="artist-album__badge">
                                            <span class="pill-badge pill-badge--yellow pill-badge--with-shadow">
                                                {{osu_trans('common.badges.new')}}
                                            </span>
                                        </span>
                                    @endif
                                </div>
                                <div class="js-react--artistTracklist" data-artist-src="{{ $artistJsonId }}" data-src="album-json-{{$album['id']}}"></div>
                                <script id="album-json-{{$album['id']}}" type="application/json">
                                    {!! json_encode($album['tracks']) !!}
                                </script>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if (count($json['tracks']) > 0)
                    <div class="artist-album">
                        <div class="artist-album__header">
                            <div class="artist-album__header-overlay" style="background-image: url('{{ $images['header_url'] }}');"></div>
                            <span class="artist-album__title">{{osu_trans('artist.songs._')}}</span>
                        </div>
                        <div class="js-react--artistTracklist" data-artist-src="{{ $artistJsonId }}" data-src="singles-json-{{$artist->id}}"></div>
                        <script id="singles-json-{{$artist->id}}" type="application/json">
                            {!! json_encode($json['tracks']) !!}
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
                @if (count($json['albums']) > 0)
                    <div class="artist__links-area artist__links-area--albums">
                        @foreach ($json['albums'] as $album)
                            <a class="artist-sidebar-album{{$album['is_new'] ? ' artist-sidebar-album--new' : ''}}" href="#album-{{$album['id']}}" data-turbolinks="false">
                                <div class="artist-sidebar-album__cover-wrapper">
                                    <div class="artist-sidebar-album__glow" style="background-image: url('{{ $album['cover_url'] }}');"></div>
                                    <img class="artist-sidebar-album__cover" src="{{$album['cover_url']}}">
                                    @if ($album['is_new'])
                                        <span class="artist__badge-wrapper">
                                            <span class="pill-badge pill-badge--yellow pill-badge--with-shadow">{{osu_trans('common.badges.new')}}</span>
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

    <script id="{{ $artistJsonId }}" type="application/json">
        {!! json_encode($json['artist']) !!}
    </script>
@endsection

@section("script")
  @parent

  @include('layout._react_js', ['src' => 'js/artist-page.js'])
@stop
