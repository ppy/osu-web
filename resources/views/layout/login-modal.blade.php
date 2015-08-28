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
<div id="login-modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog js-login-box"><div class="modal-content">
		<div class="modal-header">
			<h1>Login</h1>
		</div>

		<div class="modal-body">
			<h2>Please login to proceed</h2>

			{!! Form::open(["url" => route("users.login"), "id" => "login-form", "data-remote" => true]) !!}
				<div class="login-input">
					<input
						class="form-control modal-af"
						name="username"
						type="text"
						placeholder="{{ trans("users.login.username") }}"
						required
					>
					<input
						class="form-control"
						name="password"
						type="password"
						placeholder="{{ trans("users.login.password") }}"
						required
					>
				</div>

				<button class="btn-osu btn-osu-default login-button" type="submit"><i class="fa fa-sign-in"></i></button>
			{!! Form::close() !!}

			<p><a href="{{ config("osu.urls.user.recover_password") }}" target="_blank">Forgotten your password?</a></p>
			<p><a href="{{ config("osu.urls.user.register") }}" target="_blank">Don't have an osu! account? Make a new one</a></p>
		</div>
	</div></div>
</div>
