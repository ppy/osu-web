{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
{!! Form::open([
    'route' => 'password-reset',
    'class' => 'password-reset js-form-error',
    'method' => 'POST',
    'data-remote' => true,
    'data-reload-on-success' => '1',
    'data-skip-ajax-error-popup' => '1',
]) !!}
    <label class="password-reset__input-group">
        {{ trans('password_reset.starting.username') }}

        <input name="username" class="password-reset__input" autofocus>

        <span class="password-reset__error js-form-error--error"></span>
    </label>

    <div class="password-reset__input-group">
        <button class="btn-osu-big btn-osu-big--password-reset">
            {{ trans('password_reset.button.start') }}
        </button>
    </div>

    @if (config('services.enchant.id') !== null)
        <div>
            {!! trans('password_reset.starting.support._', ['button' => tag('a', [
                'class' => 'link link--default js-enchant--show',
                'role' => 'button',
                'href' => '#',
            ], trans('password_reset.starting.support.button'))]) !!}
        </div>

        @include('objects._enchant')
    @endif
{!! Form::close() !!}
