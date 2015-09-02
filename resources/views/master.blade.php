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
<!DOCTYPE html>
<html>
	<head>
		@include("layout.metadata")
		<title>
			@if (isset($title))
				{{ $title }}
			@else
				{{ trans("layout.menu.$current_section._") }} / {{ trans("layout.menu.$current_section.$current_action") }}
			@endif
		</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body class="{{ $current_section or "error" }} section action-{{ $current_action }} {{ $body_additional_classes or "" }}">
		<div id="overlay" style="display: none;"></div>
		<div class="blackout" style="display: none;"></div>

		@include("layout.header")

		<div class="flex-full content {{ $current_section }}_{{ $current_action }}">
			@include("layout.popup")
			@if(View::hasSection("content"))
				@yield("content")
			@else
				<div class="row-page text-center"><h1>
					<span class="dark">{{ $current_section }}</span>
					/
					<span class="dark">{{ $current_action }}</span>
					is <span class="normal">now printing</span> <span class="light">♪</span>
				</h1></div>
			@endif
		</div>

		@include("layout.gallery_window")
		@include("layout.login-modal")

		@include("layout.footer")

		<div class="fixed-bar-container">
			<div class="fixed-bar-rows-bottom">
				@yield("fixed-bar-rows-bottom")
			</div>
		</div>

		@include("layout._global_variables")
		@yield("script")
	</body>
</html>
