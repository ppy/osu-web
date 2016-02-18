{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}

@if (Auth::check())
    <div id="nav-user-bar">

        {{--
        <a href="#search" class="nav-user-search"><i class="fa fa-search"></i></a>
        <a href="#status" class="nav-user-status"><i class="fa fa-circle-o"></i></a>
        --}}
        <a href="{{ route("users.show", Auth::user()) }}">{{ Auth::user()->username }}</a>
    </div>

    <a class="avatar avatar--nav js-nav-avatar" href="#" style="background-image: url('{{ Auth::user()->user_avatar }}');" data-toggle="modal" data-target="#user-dropdown-modal"></a>
@else
    <div id="nav-user-bar">
        <a href="#" title="{{ trans("users.anonymous.login_link") }}" data-toggle="modal" data-target="#user-dropdown-modal">
            {{ trans("users.anonymous.username") }}
        </a>
    </div>

    <a class="avatar avatar--nav avatar--guest js-nav-avatar" href="#" title="{{ trans("users.anonymous.login_link") }}" data-toggle="modal" data-target="#user-dropdown-modal"></a>
@endif

@section('user-dropdown-modal')
    <div id="user-dropdown-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal__dialog js-user-dropdown-modal__dialog">
            @if (Auth::check())
                <div class="js-react--user-card"></div>
            @else
                <div class="modal-content modal-content--no-shadow">
                    <div class="modal-header modal-header--login"><h1 class="modal-header__title">{{ trans("users.login._") }}</h1></div>
                    <div class="modal-body modal-body--user-dropdown modal-body--no-rounding">
                        <h2 class="modal-body__title modal-body__title">{{ trans("users.login.title") }}</h2>

                        {!! Form::open(["url" => route("users.login"), "id" => "login-form", "class" => "modal-body__form form", "data-remote" => true]) !!}
                            <div class="form__input-group form-group form-group--compact">
                                <input class="modal-af form-group__control form-control form-group__control--compact" name="username" type="text" placeholder="{{ trans("users.login.username") }}" required>
                                <input class="form-group__control form-control form-group__control--compact" name="password" type="password" placeholder="{{ trans("users.login.password") }}" required>
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
