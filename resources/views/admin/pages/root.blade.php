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
    @include('admin._header')
    <div class="osu-page osu-page--admin">
        <h2 class="title">{{ trans('admin.pages.root.sections.general') }}</h2>
        <ul>
            <li>
                <a href="{{ route('admin.logs.index') }}">
                    {{ trans('admin.logs.index.title') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin.contests.index') }}">Contests</a>
            </li>
        </ul>

        <h2 class="title">{{ trans('admin.pages.root.sections.store') }}</h2>
        <ul>
            <li>
                <a href="{{ route('admin.store.orders.index') }}">
                    {{ trans('admin.store.orders.index.title') }}
                </a>
            </li>
        </ul>

        <h2 class="title">{{ trans('admin.pages.root.sections.forum') }}</h2>
        <ul>
            <li>
                <a href="{{ route('admin.forum.forum-covers.index') }}">
                    {{ trans('admin.forum.forum-covers.index.title') }}
                </a>
            </li>
        </ul>
    </div>
@endsection
