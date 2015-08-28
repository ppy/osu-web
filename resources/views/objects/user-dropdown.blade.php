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
@if (Auth::check())
	<div id="nav-user-bar">
		<a href="{{ route("users.show", Auth::user()) }}">{{ Auth::user()->username }}</a>
		<a
			class="js-logout-link nav-user--logout-link"
			title="{{ trans("users.logout._") }}"
			href="{{ route("users.logout") }}"
			data-method="delete"
			data-confirm="{{ trans("users.logout.confirm") }}"
			data-remote="1"
		>
			<i class="fa fa-sign-out"></i>
		</a>
	</div>

	{{--
	<!-- each of these is a notification inbox -->
	@if (Auth::user()->isBAT())
		<a href="#" class="n" id="notifications-bat">
			<span class="badge" style="color: #fa3703 !important">bat</span>
		</a>
	@endif

	@if (Auth::user()->isGMT())
		<a href="#" class="n" id="notifications-gmt">
			<span class="badge green-dark">gmt</span>
		</a>
	@endif

	@if (Auth::user()->isAdmin())
		<a href="#" class="n" id="notifications-admin">
			<span class="badge blue-dark">admin</span>
		</a>
	@endif
	--}}

	<a href="{{ route("users.show", Auth::user()) }}" class="js-nav-avatar avatar avatar--nav" style="background-image: url('{{ Auth::user()->user_avatar }}');"></a>
@else
		<div id="nav-user-bar">
			<a href="#" title="{{ trans("users.anonymous.login") }}" data-toggle="modal" data-target="#login-modal">
				{{ trans("users.anonymous.username") }}
			</a>
		</div>

	<a class="avatar avatar--nav avatar--guest js-nav-avatar" href="#" title="{{ trans("users.anonymous.login") }}" data-toggle="modal" data-target="#login-modal">
	</a>
@endif
