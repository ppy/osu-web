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
    <div id="download-header" class="row-page">
            <p>let's get</p>
            <p>you started</p>
            <p>download osu! game client for Windows</p>
    </div>

    <div class="row-page row-blank" id="download-button">
        <a href="http://m1.ppy.sh/r/osu!install.exe"><img class="round" src="/images/download-button.png" alt="osu! online installer" /></a>
    </div>

    <div class="row-page" id="download-steps">
        <div>
            <h1>Step 1</h1>
            <p>Download the osu! game client</p>
        </div>
        <div>
            <h1>Step 2</h1>
            <p>Create an osu! player account</p>
        </div>
        <div>
            <h1>Step 3</h1>
            <p>???</p>
        </div>
    </div>

    <div class="row-page" id="download-guides">
        <div class="explanation">
            <h4>Learn more?</h4>

            <p>
                Check out the <a href="https://www.youtube.com/user/osuacademy/">osu!academy YouTube Channel</a> for up-to-date tutorials and tips on how to get the most out of osu!
            </p>
        </div>

        <div class="embed-responsive embed-responsive-16by9">
            <iframe src="https://www.youtube.com/embed/videoseries?list=PLmWVQsxi34bMYwAawZtzuptfMmszUa_tl" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
@stop
