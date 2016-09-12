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
    'title' => "Featured Artist: $artist->name",
    'pageDescription' => $artist->description,
    'body_additional_classes' => 'osu-layout--body-darker'
])

@section("content")
    @include('objects.css-override', ['mapping' => [
        '.osu-page-header-v2--artist' => $images['header_url'],
        '.artist__portrait' => $images['cover_url'],
        '.artist__label-overlay' => $artist->label ? $artist->label->icon_url : '',
    ]])

    <div class="osu-layout__row">
        <div class="osu-page-header-v2 osu-page-header-v2--artist">
            <div class="osu-page-header-v2__overlay"></div>
            <div class="osu-page-header-v2__subtitle osu-page-header-v2__subtitle--artist"><a class="artist__white-link" href="{{route('artist.index')}}">{{trans('artist.title')}} &raquo;</a></div>
            <div class="osu-page-header-v2__title">{{$artist->name}}</div>
        </div>
    </div>
    <div class="osu-layout__row osu-layout__row--page-artist">
        <div class="page-contents page-contents--artist">
            <div class="page-contents__content--artist-left">
                <div class="artist__description">{!! $artist->description !!}</div>
                <div class="js-react--artistTracklist"></div>
            </div>
            <div class="page-contents__content--sidebar">
                <div class="artist__portrait">
                    @if($artist->label !== null)
                        <a class="artist__label-overlay" href="{{$artist->label->website}}"></a>
                    @endif
                </div>
                <div class="artist__links-area">
                    @foreach ($links as $link)
                        <div class='btn-osu btn-osu--artist'>
                            <a class="artist__link" href="{{$link['url']}}">
                                <i class='fa fa-fw fa-{{$link['icon']}}'></i>
                                <span class="artist__link-text">{{$link['title']}}</span>
                                <i class='fa fa-fw fa-chevron-right artist__chevron artist__chevron--{{$link['class']}}'></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
  @parent

  <script id="json-tracks" type="application/json">
    {!! json_encode($tracks) !!}
  </script>

  <script src="{{ elixir("js/react/artist-page.js") }}" data-turbolinks-track></script>
@stop
