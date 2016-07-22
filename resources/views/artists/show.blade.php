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
    'current_section' => 'community',
    'current_action' => 'artists',
    'title' => 'page title here',
    'pageDescription' => 'page description here',
    'body_additional_classes' => 'osu-layout--body-dark'
])

@section("content")
    <div class="osu-layout__row">
        <div class="osu-page-header osu-page-header--artist">
            <div class="osu-page-header--artist__subtitle">Artist &raquo;</div>
            <div class="osu-page-header--artist__title">{!! $artist->name !!}</div>
        </div>
    </div>
    <div class="osu-layout__row osu-layout__row--page-artist">
        <div class="page-contents">
            <div class="page-contents__content--artist-left">
                <div class="artist__description">{!! $artist->description !!}</div>
                <div class="artist__tracklisting">
                    <table class="artist__tracklisting-table">
                        <thead style="text-transform: uppercase; color: #8dacb6; font-size: 10px; line-height: 32px;">
                            <tr>
                                <th colspan="2"></th>
                                <th>title</th>
                                <th>bpm</th>
                                <th>genre</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tracks as $track)
                            <tr style="background-color: #293336; color: #8dacb6; font-weight: 100; font-size: 12px; border-bottom: 2px solid #1A2223;">
                                <td class="cover" style="width: 32px; height: 32px; background-color: #A4CA00;"></td>
                                <td class="preview" style="width: 32px; height: 32px; color: #3C4347; text-align: center;"><i class='fa fa-fw fa-play'></i></td>
                                <td class="title"><span style="color: white;">{!! $track->title !!}</span> <span style="font-size: 10px">Original Mix</span></td>
                                <td class="bpm">{!! $track->bpm !!}bpm</td>
                                <td class="genre">{!! $track->genre !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="page-contents__content--sidebar">
                <img class="artist__portrait" src="http://placekitten.com/g/256/256">
                <div class="artist__links">
                    @if($artist->soundcloud !== null)
                        <div class='btn-osu btn-osu--artist' style="height: 50px; margin-bottom: 5px; background-color: #1A2123; line-height: 40px">
                            <a href="#" style="color: white; display: inline-block; width: 100%; display: flex; align-items: center;">
                                <i class='fa fa-fw fa-soundcloud'></i>
                                <span style="font-weight: 200; flex-basis: 100%; text-align: left; padding-left: 20px">Soundcloud</span>
                                <i class='fa fa-fw fa-chevron-right' style="right: 0;"></i>
                            </a>
                        </div>
                    @endif
                    @if($artist->website !== null)
                        <div class='btn-osu btn-osu--artist' style="height: 50px; margin-bottom: 5px; background-color: #1A2123; line-height: 40px">
                            <a href="{!!$artist->website!!}" style="color: white; display: inline-block; width: 100%; display: flex; align-items: center;">
                                <i class='fa fa-fw fa-globe'></i>
                                <span style="font-weight: 200; flex-basis: 100%; text-align: left; padding-left: 20px">Official Website</span>
                                <i class='fa fa-fw fa-chevron-right' style="right: 0;"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
