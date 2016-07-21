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
    @include('objects.user-dropdown-modal')
@stop
