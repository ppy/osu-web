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

		<a href="#search" class="nav-user-search"><i class="fa fa-search"></i></a>
		<a href="#status" class="nav-user-status"><i class="fa fa-circle-o"></i></a>
		<a href="{{ route("users.show", Auth::user()) }}">{{ Auth::user()->username }}</a>
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
		@if (Auth::check())
			<div class="modal-dialog js-user-dropdown-box js-user-dropdown-authenticated">
				<div class="badges">
					<div class='user-dropdown-badge user-dropdown-level-badge'>
						<span class='user-dropdown-badge-number'>5</span>
					</div>
					<div class='user-dropdown-badge user-dropdown-achievements-badge'>
						<span class='user-dropdown-badge-number'>5</span>
					</div>
				</div>
				<div class="modal-content">
					<div class="modal-header" style="background-image: url('/temp-issue-35-related/bg-cover.png');">
						<div class="dimmer"></div>
						<div class="pull-left userinfo">
							<h1>{{ Auth::user()->username }}</h1>
							<a href="#/rankings/country-maybe?" class="country ja">&nbsp;</a>
							<a href="#/teams/ppy" class="team" style="background-image: url('/temp-issue-35-related/default-team.png');">&nbsp;</a>
						</div>
						<div class="pull-right ranking">
							<h1>#37542</h1>
							<h2>Malaysia #37542</h2>
						</div>
					</div>
					<div class="modal-body row">
						<div class="col-xs-8 info">
							<h1>Level 5</h1>
							<ul class="roles">
								<li class="supporter">osu!Supporter</li>
								<li class="developer">osu!Developer</li>
							</ul>
							<ul class="stats">
								<li><span>Ranked Score</span><span class="pull-right">{{ number_format(29955840356) }}</span></li>
								<li><span>Hit Accuracy</span><span class="pull-right">{{ number_format(98.75, 2) }}%</span></li>
								<li><span>Play Count</span><span class="pull-right">{{ number_format(100475) }}</span></li>
							</ul>
						</div>
						<div class="col-xs-4 menu">
							<ul>
								<li>
									<a href="#">
										Messages <i class="fa fa-envelope"></i>
									</a>
								</li>
								<li>
									<a href="#">
										Settings <i class="fa fa-cog"></i>
									</a>
								</li>
								<li>
									<a
										class="js-logout-link"
										title="{{ trans("users.logout._") }}"
										href="{{ route("users.logout") }}"
										data-method="delete"
										data-confirm="{{ trans("users.logout.confirm") }}"
										data-remote="1"
									>
										Log Out <i class="fa fa-sign-out"></i>
									</a>
								</li>
								<li>
									<a href="#">
										Help <i class="fa fa-question-circle"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		@else
			<div class="modal-dialog js-user-dropdown-box js-user-dropdown-guest">
				<div class="modal-content">
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
			</div>
		</div>
	@endif
@stop