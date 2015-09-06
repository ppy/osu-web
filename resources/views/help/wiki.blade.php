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
<div class="row-page wiki-header">
    <div class="text">
        <h2><i>Getting Started</i></h2>
        <h1><i>Hit Objects</i></h1>
    </div>
</div>

<div class="wiki-page">

    <div class="wiki-nav-container">

        <div id="wikinav" class="wiki-nav">

            <div class="wiki-button top">
                <span id="hideWikiNav" class="fa-stack">
			<div class="wiki-outer"><i class="fa fa-circle fa-stack-2x"></i></div>
			<div class="wiki-inner"><i class="fa fa-bars fa-stack-1x"></i></div>
		</span>
            </div>

            <br>
            <b><i>Wiki Navigation</i></b>
            <a href=""><b><i>Home</i></b></a>
            <a href=""><b><i>Current events</i></b></a>
            <a href=""><b><i>Recent changes</i></b></a>
            <a href=""><b><i>Random page</i></b></a>
            <a href=""><b><i>Help</i></b></a>
            <br>
            <b><i>Toolbox</i></b>
            <a href=""><b><i>What links here</i></b></a>
            <a href=""><b><i>Related changes</i></b></a>
            <a href=""><b><i>Special pages</i></b></a>
            <a href=""><b><i>Printable version</i></b></a>
            <a href=""><b><i>Permanent link</i></b></a>
            <br>
        </div>

        <div class="wiki-nav-bottom">
            <div class="wiki-button bottom">
                <span id="showWikiNav" class="fa-stack">
				<div class="wiki-outer"><i class="fa fa-circle fa-stack-2x"></i></div>
				<div class="wiki-inner"><i class="fa fa-bars fa-stack-1x"></i></div>
			</span>
            </div>
        </div>

    </div>

    <div class="sub">
        <div class="margined">
            <div class="language-labels">
                <p><i>Other Languages: <a href="">French</a><a href="">German</a><a href="">Spanish</a><a href="">Dutch</a></i>
                </p>
            </div>
        </div>
    </div>

    <div class="primary">
        <div class="margined">
            <p>A hit object is the core gameplay element in osu!. There are three types of hit objects:</p>► Hit Circle
            <br>► Slider
            <br>► Spinner</p>
            <p>Hit circles and sliders are encountered frequently, while spinners only appear occasionally. Everything you interact with during the course of a beatmap is a hit object.</p>
        </div>
    </div>

    <div class="sub">
        <div class="margined">
            <b>CONTENTS</b>
            <br>
            <div class="wiki-contents"><a href=""><b><i>1 Hit Circle</i></b></a>
                <br><a href=""><b><i>2 Slider</i></b></a>
            </div>
        </div>
    </div>

    <div class="primary">
        <div class="margined">
            <div class="row wiki-box">
                <div class="col-md-12">
                    <p class="title">Hit Circle</p>
                </div>
            </div>
            <p>Called Hit Marker in the DS games. It's a coloured circle with a number on it (depending on its place in a Combo) with the outline of another circle (Approach Circle) shrinking around it. Once the Approach Circle outline overlaps the Hit Circle's border, the player should Tap the Hit Circle, earning a number of points (50, 100 or 300) depending on how accurate his tapping was, and possibly scoring a Beat! or an Elite Beat! if the circle is the end of a combo. Tapping regular Hit Circles gives a very small boost to the Life Bar, and a good boost if it is a end combo circle.</p>

            <div class="row wiki-box">
                <div class="col-md-12">
                    <p class="title">Slider</p>
                </div>
            </div>
            <p><i>Main article: <a href=""><b>Slider</b></a></i>
            </p>
            <p>A Slider consists of two Hit Circles with a straight path or a Bezier Curve between them. An Approach Circle is around the beginning Hit Circle of the Slider. Once the Approach Circle reaches its border, the player must tap the beginning of the Slider and then, keeping the button pressed, follow (with his cursor) a moving graphical image [called Slider Ball - An graphic (ball-shaped by default) that moves along a Slider's path based on BPM and Slider Velocity given by the mapper] along the Slider's path until the end Hit Circle is reached. If there is a reverse arrow graphic at that point, the player follows the Slider Ball back along the same path and repeats as long as a reverse arrow graphic is visible.
                <br>Slider Ticks are small circles that appear in regular intervals along a Slider's path.</p>
        </div>
    </div>
</div>

<div class="wiki-page">
    <div class="wiki-title vertical-borders">
        <font>Contents</font>
    </div>
    <div class="content-container">
        <div class="row">
            <div class="column-left">Getting Started</div>
            <div class="column-right">

                <a href="">Registration</a> •
                <a href="">Installation</a> •
                <a href="">Beginner's Guide</a> •
                <a href="">osu! Rules</a> •
                <a href="">Hit Objects</a> •
                <a href="">Game Interface</a> •
                <a href="">Options</a> •
                <a href="">Glossary</a>
                <a href="">List of Guides</a> •
                <br>
                <a href="">Shortcut Key Reference</a> •
                <a href="">osu! Program Files</a> •
                <a href="">BBCode</a> •
                <a href="">osu! File Formats</a>
            </div>
        </div>
        <div class="row">
            <div class="column-left">osu! Game Styles</div>
            <div class="column-right">
                <a href="">Basic explanation</a> •
                <a href="">osu! Standard</a> •
                <a href="">Taiko</a> •
                <a href="">Catch The Beat</a> •
                <a href="">osu!mania</a> •
                <a href="">Multi-play</a> •
                <br> External Ports(<a href="">osu!stream</a> • <a href="">osu!droid</a> • <a href="">T-Aiko</a> • <a href="">osu!WP</a>)
            </div>
        </div>
        <div class="row">
            <div class="column-left">World of osu!</div>
            <div class="column-right">
                <a href="">Beatmaps</a> •
                <a href="">Game Modifiers</a> •
                <a href="">Achievements</a> •
                <a href="">History of osu!</a> •
                <a href="">Performance Points</a> •
                <a href="">Play Styles</a> •
                <a href="">Score</a> •
                <a href="">Accuracy</a> •
                <a href="">Chat Console</a> •
                <a href="">BanchoBot</a>(<a href="">FAQ command list</a>) •
                <a href="">Live streaming osu!</a> •
                <a href="">Internet Relay Chat</a> •
                <a href="">Tournaments/Showcases</a> •
                <a href="">osu!academy</a> •
                <a href="">osu!supporter</a> •
                <a href="">Mascots</a> •
                <a href="">osu!talk</a>
            </div>
        </div>
        <div class="row">
            <div class="column-left"><a href="">Beatmap Editor</a>
            </div>
            <div class="column-right">
                <a href="">Compose</a> /
                <a href="">Design</a> /
                <a href="">Timing</a> /
                <a href="">Song Setup</a>
                <br>
                <a href="">Beatmapping</a> •
                <a href="">Beat Snap Divisor</a> /
                <a href="">Distance Snap</a> •
                <a href="">Custom Sample Overrides</a> •
                <a href="">Kiai Time</a> •
                <a href="">Mapping Techniques</a> •
                <a href="">Skinning</a> (<a href="">Skin.ini</a>) •
                <a href="">Storyboarding</a> •
                <a href="">Storyboard Scripting</a>
                <br> Difficulties(
                <a href="">Easy</a>, <a href="">Normal</a>, <a href="">Hard</a>, <a href="">Insane</a>)
            </div>
        </div>
        <div class="row">
            <div class="column-left">Online Editing and Ranking</div>
            <div class="column-right">
                <a href="">Beatmap Approval</a> •
                <a href="">Getting Your Map Modded</a> •
                <a href="">How to Get Your Map Ranked</a> •
                <a href="">Kudosu</a> •
                <a href="">Modding</a> •
                <a href="">Ranking</a> •
                <a href="">Criteria</a> (For <a href="">Standard</a>, <a href="">Taiko</a>, <a href="">Catch the Beat</a>, <a href="">osu!mani</a>) •
                <a href="">Star Priority</a> •
                <a href="">Submission</a> •
                <a href="">WIP</a> •
                <a href="">Music Theory</a> •
                <a href="">Audio Editing</a>
            </div>
        </div>
        <div class="row">
            <div class="column-left">People</div>
            <div class="column-right">
                <a href="">Administrators</a>/<a href="">Global Moderation Team</a> •
                <a href="">Quality Assurance Team</a> •
                <a href="">Beatmap Appreciation Team</a> •
                <a href="">Langauge Moderators</a> •
                <a href="">Mappers</a> •
                <a href="">osu! Alumni</a> •
                <a href="">Community Contributors</a> •
                <a href="">List of notable people</a> •
                <a href="">Support Team</a>
            </div>
        </div>
    </div>
</div>

<script>
    //example script for nav

    $("#showWikiNav").hide();

    $('#showWikiNav').click(function() {
        $("#showWikiNav").hide();
        $("#wikinav").show();
    });

    $('#hideWikiNav').click(function() {
        $("#wikinav").hide();
        $("#showWikiNav").show();
    });
</script>

@stop