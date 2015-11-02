{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, version 3 of the License.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
<div href='/beatmaps/modding/{{ $beatmap->beatmapset_id }}' class='beatmap object_link' objectid='{{ $beatmap->beatmapset_id }}'>
    <div class='thumbnail' style='background-image: url("{{ Config::get("osu.static", "//b.ppy.sh") }}/thumb/{{ $beatmap->beatmapset_id }}l.jpg")'>
        <div class="bottom_left">
            <div class='title'>
                <span title="{{{ $beatmap->title }}}">{{{ $beatmap->title }}}</span>
            </div>
            <div class='artist'>
                <span title="{{{ $beatmap->artist }}}">{{{ $beatmap->artist }}}</span>
            </div>
        </div>

        <div class="top_right">
            <div class='stats'>
                <div class='plays'>
                    <span title="{{{ $beatmap->play_count }}}">
                        {{{ $beatmap->play_count }}}
                    </span>
                    <i class='fa fa-play-circle'></i>
                </div>

                <div class='favourites'>
                    <span title="{{{ $beatmap->favourite_count }}}">
                        {{{ $beatmap->favourite_count }}}
                    </span>
                    <i class='fa fa-heart'></i>
                </div>
            </div>
        </div>
    </div>

    <div class='bottom_left'>
        <span class="hidden" ref="{{ $beatmap->beatmapset_id }}">{{ $beatmap->beatmapset_id }}</span>

        <div class='creator'>
            {!! trans("beatmaps.listing.mapped-by", ["mapper" => "<a href='/u/$beatmap->user_id'>$beatmap->creator</a>"]) !!}
        </div>

        @if($beatmap->source)
        <div class='source'>
            {{ trans("beatmaps.listing.source", ["source" => $beatmap->source]) }}
        </div>
        @endif
    </div>

    <div class="bottom_right show_on_hover">
        <a href='#' class="object_link"><i class="fa fa-download"></i></a>
        <a href='#' class="object_link"><i class="fa fa-comments-o"></i></a>
        <a href='#' class="object_link"><i class='fa fa-heart'></i></a>
    </div>

    <paper-shadow z="1" animated="true"></paper-shadow>
</div>