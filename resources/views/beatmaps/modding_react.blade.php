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

<div class="row">
	<div class="col-md-6">
		<h4><a href="/beatmaps/modding">Modding Portal</a> » Beatmap Discussion</h4>
		<h3>{{{$beatmapSet->title}}}</h3>
		<h4 class="text-muted">{{{$beatmapSet->artist}}} <small>mapped by {{{$beatmapSet->creator}}}</small></h4>
		<style>

		</style>
		<i data-target="osu" class="score-selector fa fa-2x fa-osu-o osu"></i>
		<i data-target="taiko" class="score-selector fa fa-2x fa-taiko-o osu"></i>
		<i data-target="ctb" class="score-selector fa fa-2x fa-ctb-o osu"></i>
		<i data-target="mania" class="score-selector fa fa-2x fa-mania-o osu"></i>
	</div>
	<div class="col-md-6 visible-md visible-lg">
		@include("objects.beatmap-panel", ["beatmap" => $beatmapSet])
	</div>
</div>

<div id="topics"></div>
@stop

@section ('script')
	@parent

	<script src="{{ elixir("js/jsx/modding_react.js") }}" data-turbolinks-eval="always" data-turbolinks-track></script>
@endsection
