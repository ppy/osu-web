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
@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'section' => trans('layout.header.notice._'),
    ]])

    <div class="osu-page osu-page--generic">
        <h1>{{ trans('users.disabled.title') }}</h1>

        <p>
            {{ trans('users.disabled.reasons.opening') }}
        </p>

        <ul>
            <li>
                {!! trans('users.disabled.reasons.tos._', [
                    'community_rules' => tag('a', [
                        'href' => osu_url('user.rules'),
                    ], trans('users.disabled.reasons.tos.community_rules')),
                    'tos' => tag('a', [
                        'href' => route('legal', 'terms'),
                    ], trans('users.disabled.reasons.tos.tos')),
                ]) !!}
            </li>
            <li>
                {{ trans('users.disabled.reasons.compromised') }}
            </li>
        </ul>

        <p>
            {!! trans('users.disabled.warning') !!}
        </p>

        <p>
            {!! trans('users.disabled.if_mistake._', [
                'email' => tag('a', [
                    'href' => 'mailto:'.config('osu.emails.account')
                ], trans('users.disabled.if_mistake.email')),
            ]) !!}
        </p>

        @include('objects._enchant')
    </div>
@endsection
