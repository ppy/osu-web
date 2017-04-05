{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
@extends('master')

@section('content')
    @if ($isStarted)
        <div class="osu-layout__row osu-layout__row--page">
            {{ trans('password_reset.title') }}

            {!! Form::open([
                'route' => 'password-reset.set',
                'method' => 'POST',
                'data-remote' => true,
            ]) !!}
                <a href="{{ route('password-reset') }}" data-method="DELETE">
                    {{ trans('password_reset.button.cancel') }}
                </a>
                <input name="key" autofocus>
                <input type="password" name="user_password[password]">
                <input type="password" name="user_password[password_confirmation]">
                <button>{{ trans('password_reset.button.set') }}</button>
            {!! Form::close() !!}
        </div>
    @else
        <div class="osu-layout__row osu-layout__row--page">
            {{ trans('password_reset.title') }}

            {!! Form::open([
                'route' => 'password-reset',
                'method' => 'POST',
                'data-remote' => 'true',
                'data-reload-on-success' => '1',
            ]) !!}
                <input name="username" autofocus>
                <button>{{ trans('password_reset.button.start') }}</button>
            {!! Form::close() !!}
        </div>
    @endif
@endsection
