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
{!! trans('common.email.hello', ['user' => $user->username]) !!}

{!! trans('user_verification.email.content.action_from._', [
    'country' => $requestCountry ?? trans('user_verification.email.content.action_from.unknown_country'),
]) !!}

{!! trans('user_verification.email.content.code') !!} {{ $keys['main'] }}
{!! trans('user_verification.email.content.code_hint') !!}

{!! trans('user_verification.email.content.link') !!}

{{ route('account.verify', ['key' => $keys['link']]) }}

{!! trans('user_verification.email.content.report') !!}

@include('emails._signature')
