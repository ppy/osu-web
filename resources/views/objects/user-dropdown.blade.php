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

{{--
<!-- OLD LOGIC, WE'LL MOVE THIS BIT IN A BIT! (Trust me, I'm a developer..) -->
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

	<a class="avatar avatar--nav js-nav-avatar" href="#" title="{{ trans("users.anonymous.login") }}" style="background-image: url('{{ Auth::user()->user_avatar }}');" data-toggle="modal" data-target="#user-dropdown-modal"></a>
@else
	<div id="nav-user-bar">
		<a href="#" title="{{ trans("users.anonymous.login") }}" data-toggle="modal" data-target="#user-dropdown-modal">
			{{ trans("users.anonymous.username") }}
		</a>
	</div>

	<a class="avatar avatar--nav avatar--guest js-nav-avatar" href="#" title="{{ trans("users.anonymous.login") }}" data-toggle="modal" data-target="#user-dropdown-modal"></a>
@endif

@section('user-dropdown-modal')
	<div id="user-dropdown-modal" class="modal fade" tabindex="-1">
		<div class="modal-dialog js-user-dropdown-box">
			@if (Auth::check())
				<div class="modal-content authenticated">
					<div class="modal-header">{{ Auth::user()->username }}</div>
					<div class="modal-body">
						<h2>Hey! Look! We're logged in! Now get back to work!</h2>
					</div>
				</div>
			@else
				<div class="modal-content guest">
					<div class="modal-header"><h1>Login</h1></div>
					<div class="modal-body">
						<h2>Please login to proceed</h2>

						{!! Form::open(["url" => route("users.login"), "id" => "login-form", "data-remote" => true]) !!}
							<div class="login-input">
								<input class="form-control" name="username" type="text" placeholder="{{ trans("users.login.username") }}" required>
								<input class="form-control" name="password" type="password" placeholder="{{ trans("users.login.password") }}" required>
							</div>

							<button class="btn-osu btn-osu-default login-button" type="submit"><i class="fa fa-sign-in"></i></button>
						{!! Form::close() !!}

						<p><a href="{{ route("users.forgot-password") }}" target="_blank">Forgotten your password?</a></p>
						<p><a href="{{ route("users.register") }}" target="_blank">Don't have an osu! account? Make a new one</a></p>
					</div>
				</div>
			@endif
		</div>
	</div>
@stop