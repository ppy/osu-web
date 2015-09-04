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
<nav class="flex-none flex-column no-print">
	<!-- Specific style for smaller displays (smartphone) -->
	<div class="visible-xs">
		<div class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#xs-navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="logo" href="/"></a>
					<span class="navbar-brand">
						<span class="sub1">{{ trans("layout.menu.$current_section._") }}</span>
						/
						<span class="darker normal">{{ trans("layout.menu.$current_section.$current_action") }}</span>
					</span>
				</div>
			</div>
		</div>

		<div class="collapse navbar-collapse" id="xs-navbar">
			<ul class="nav navbar-nav">
				@foreach (nav_links() as $section => $links)
				<li class="dropdown">
					<a data-toggle="dropdown" role="button" data-target="#" id="expand-{{ $section }}" class="dropdown-toggle" href="{{ array_values($links)[0] }}">
						{{ trans("layout.menu.$section._") }}
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="expand-{{ $section }}">
						@foreach ($links as $action => $link)
						<li>
							<a href="{{ $link }}" data-toggle="collapse" data-target="#xs-navbar">{{ trans("layout.menu.$section.$action") }}</a>
						</li>
						@endforeach
					</ul>
				</li>
				@endforeach
			</ul>
		</div>
	</div>

	<!-- Main style -->
	<div id="nav-background" class="hidden-xs">
		<div id="nav-triangles-1" class="nav-triangles"></div>
		<div id="nav-triangles-2" class="nav-triangles"></div>
		<div id="nav-triangles-3" class="nav-triangles"></div>
		<div id="nav-gradient-overlay"></div>
	</div>

	<div class="hidden-xs row-page row-blank row-compact nav-sm">
		<a class="flex-none nav-logo" href="/"></a>

		<div id="nav-links">
			<ul id="nav-menu">
				@foreach (nav_links() as $section => $links)
					<li class="{{ $section }} {{ $current_section === $section ? " active" : "" }}">
						<a href="{{ array_values($links)[0] }}">{{ trans("layout.menu.$section._") }}</a>

						<div class="submenu"><ul>
							<li class="section">{{ trans("layout.menu.$section._") }}</li>
							@foreach ($links as $action => $link)
								<li class="subsection {{ $action }} {{ ($current_section === $section && $current_action === $action) ? "active" : "" }}">
									<a href="{{ $link }}">{{ trans("layout.menu.$section.$action") }}</a>
								</li>
							@endforeach
						</ul></div>
					</li>
				@endforeach

				<li data-submenu="0">
					<a class="yellow-normal" href="{{ config("osu.urls.support-the-game") }}" target="_blank">support the game</a>
				</li>
				<li data-submenu="0" class="social">
					<a href="{{ config("osu.urls.social.facebook") }}" target="_blank"><i class="fa fa-facebook-f"></i></a>
				</li>
				<li data-submenu="0" class="social">
					<a href="{{ config("osu.urls.social.twitter") }}" target="_blank"><i class="fa fa-twitter"></i></a>
				</li>
			</ul>

			<div id="nav-page-title">
				<span class="sub1">{{ trans("layout.menu.$current_section._") }}</span>
				<span class="sub2">{{ trans("layout.menu.$current_section.$current_action") }}</span>
			</div>
		</div>

		<div class="flex-none nav-user-bar-container">
			@include("objects.user-dropdown")
		</div>
	</div>
</nav>

<div id="popup-container">
	<div class="alert alert-dismissable popup-clone col-md-6 col-md-offset-3 text-center" style="display: none">
		<button type="button" data-dismiss="alert" class="close"><i class="fa fa-close"></i></button>
		<span class="popup-text"></span>
	</div>
</div>
<div id="loading-screen"></div>
<div id="loading-area">
	<div class="spinner">
		<div class="spinner-container">
			<div class="approach obj1"></div>
			<div class="approach obj2"></div>
			<div class="approach obj3"></div>
			<div class="approach obj4"></div>
			<div class="hit obj1"></div>
			<div class="hit obj2"></div>
			<div class="hit obj3"></div>
			<div class="hit obj4"></div>
		</div>
	</div>
</div>
