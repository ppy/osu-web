{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends("master")

@section("content")
    <div id='search' class='search'>
        <div class='box'>
            <input type='textbox' name='search' placeholder='{{{ trans("beatmaps.listing.search.prompt") }}}'>
            <i class='fa fa-search'></i></input>
        </div>

        <div class='selector'>
            <span class='header'>Mode</span>
            <a href='#' class='active'>{{{ trans("beatmaps.listing.all") }}}</a>
            <a href='#'>osu!</a>
            <a href='#'>Taiko</a>
            <a href='#'>Catch the Beat</a>
            <a href='#'>osu!mania</a>
        </div>

        <div class='selector'>
            <span class='header'>Rank Status</span>
            <a href='#' class='active'>{{{ trans("beatmaps.listing.ranked-approved") }}}</a>
            <a href='#'>{{{ trans("beatmaps.listing.faves") }}}</a>
            <a href='#'>{{{ trans("beatmaps.listing.modreqs") }}}</a>
            <a href='#'>{{{ trans("beatmaps.listing.pending") }}}</a>
            <a href='#'>{{{ trans("beatmaps.listing.all") }}}</a>
        </div>

        <div class='more gray_link'>
            <a href='#'>
                <div>{{{ trans("beatmaps.listing.search.options") }}}</div>
                <div><i class='fa fa-angle-down'></i></div>
            </a>
        </div>
    </div>
    <div id='beatmaps' class='beatmaps padding'>
        @foreach ($beatmaps as $beatmap)
            @include("objects.beatmap-panel", ["beatmap", $beatmap])
        @endforeach
    </div>
    <div class='padding centre'>
        <a href='#' id='load_more'>{{{ trans("beatmaps.listing.load-more") }}}</a>
    </div>
@stop

@section("script")
    <script>
        var pending = function() {
            var loaded_count = 20;

            $(window).scroll(function() {
                if($(window).scrollTop() == $(document).height() - $(window).height()) {
                    osu.loadMore('beatmap', loaded_count);
                    loaded_count += 20;
                }
            });
        };
    </script>
@stop
