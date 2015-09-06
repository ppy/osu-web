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

	<a class="avatar avatar--nav js-nav-avatar" href="#" title="{{ trans("users.show.avatar", ["username" => Auth::user()->username]) }}" style="background-image: url('{{ Auth::user()->user_avatar }}');" data-toggle="modal" data-target="#user-dropdown-modal"></a>
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
		<div class="modal-dialog modal__dialog js-user-dropdown-modal__dialog">
			@if (Auth::check()) 
				<div class="modal-content modal-content--authenticated">
					<div class="modal-header modal-header--authenticated" style="background-image: url('/temp-issue-35-related/bg-cover.png');">
						<div class="modal-header__dimmer"></div>
						<div class="modal-header__badges badges">
							<i class='badges__badge badges__badge--small badges__badge--level'>5</i>
							<i class='badges__badge badges__badge--small badges__badge--achievements'>5</i>
						</div>
						<div class="modal-header__userinfo userinfo-small">
							<h1 class="userinfo-small__username">{{ Auth::user()->username }}</h1>
							<a href="#/rankings/country-maybe?" class="userinfo-small__country" style="background-image: url('/images/flags/{{ Auth::user()->country_acronym }}.png');"></a>
							<a href="#/teams/ppy" class="userinfo-small__team" style="background-image: url('/temp-issue-35-related/default-team.png');"></a>
						</div>
						<div class="modal-header__ranking rankinginfo-small">
							<span class="rankinginfo-small__gamemode"><i class="fa osu fa-ctb-o"></i> #37542</span>
							<span class="rankinginfo-small__country">Malaysia #37542</span>
						</div>
					</div>
					<div class="modal-body modal-body--compartimentalized">
						<div class="modal-body__compartment modal-body__compartment--left quick-info">
							<h1 class="quick-info__level">Level 5</h1>
							<ul class="quick-info__roles user-roles">
								<li class="user-roles__role user-roles__role--supporter">{{ trans("users.show.is_supporter") }}</li>
								<li class="user-roles__role user-roles__role--developer">{{ trans("users.show.is_developer") }}</li>
							</ul>
							<ul class="quick-info__statistics">
								<li class="quick-info-statistics__statistic"><span>{{ trans("users.show.stats.ranked_score") }}</span><span class="text-right">{{ number_format(29955840356) }}</span></li>
								<li class="quick-info-statistics__statistic"><span>{{ trans("users.show.stats.hit_accuracy") }}</span><span class="text-right">{{ number_format(98.75, 2) }}%</span></li>
								<li class="quick-info-statistics__statistic"><span>{{ trans("users.show.stats.play_count") }}</span><span class="text-right">{{ number_format(100475) }}</strong></li>
							</ul>
						</div>
						<div class="modal-body__compartment modal-body__compartment--right">
							<ul class="user-dropdown-modal-menu">
								<li class="user-dropdown-modal-menu__item"><a href="#" title="{{ trans("layout.menu.user.messages") }}">{{ trans("layout.menu.user.messages") }} <i class="fa fa-envelope"></i></a></li>
								<li class="user-dropdown-modal-menu__item"><a href="#" title="{{ trans("layout.menu.user.settings") }}">{{ trans("layout.menu.user.settings") }} <i class="fa fa-cog"></i></a></li>
								<li class="user-dropdown-modal-menu__item"><a href="{{ route("users.logout") }}" title="{{ trans("layout.menu.user.logout") }}" class="js-logout-link" data-method="delete" data-confirm="{{ trans("users.logout_confirm") }}" data-remote="1">{{ trans("layout.menu.user.logout") }} <i class="fa fa-sign-out"></i></a></li>
								<li class="user-dropdown-modal-menu__item"><a href="#" title="{{ trans("layout.menu.user.help") }}">{{ trans("layout.menu.user.help") }} <i class="fa fa-question-circle"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			@else
				<div class="modal-content modal-content--no-shadow">
					<div class="modal-header modal-header--login"><h1 class="modal-header__title">{{ trans("users.login._") }}</h1></div>
					<div class="modal-body modal-body--no-rounding">
						<h2 class="modal-body__title modal-body__title">{{ trans("users.login.title") }}</h2>

						{!! Form::open(["url" => route("users.login"), "id" => "login-form", "class" => "modal-body__form form", "data-remote" => true]) !!}
							<div class="form__input-group input-group">
								<input class="input-group__control form-control" name="username" type="text" placeholder="{{ trans("users.login.username") }}" required>
								<input class="input-group__control form-control" name="password" type="password" placeholder="{{ trans("users.login.password") }}" required>
							</div>

							<button class="btn-osu btn-osu-default form__button" type="submit"><i class="fa fa-sign-in"></i></button>
						{!! Form::close() !!}

						<p class="modal-body__paragraph"><a href="{{ route("users.forgot-password") }}" target="_blank">{{ trans("users.login.forgot") }}</a></p>
						<p class="modal-body__paragraph"><a href="{{ route("users.register") }}" target="_blank">{{ trans("users.login.register") }}</a></p>
					</div>
				</div>
			@endif
		</div>
	</div>
@stop