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

    <div class="padding">
        <div class="col-xs-12">
            <h2>
                <a href='/beatmaps/modding/'>Modding Portal</a> &raquo; Home
                <small>
                    <a href="/help/faq#modding">(what the heck is this?)</a>
                </small>
            </h2>

            <h3>Note: UI is not designed yet.</h3>
        </div>

        <div class="col-md-5">
            <h2>Queue</h2>
            <div class="col-xs-12" style="padding: 0 0 15px 0;">
                @include("objects.beatmap-panel", ["beatmap" => BeatmapSet::find(76127)])
            </div>
        </div>
        <div class="col-xs-1">

        </div>
        <div class="col-md-5">
            <h2>Qualified</h2>
            <div class="col-xs-12" style="padding: 0 0 15px 0;">
                @include("objects.beatmap-panel", ["beatmap" => BeatmapSet::find(76127)])
            </div>
        </div>

    </div>

@stop
