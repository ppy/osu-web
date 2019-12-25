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
@extends('master', [
    'title' => 'Contests Admin',
])


@section('content')
    @include('admin/_header', ['title' => trans('layout.header.admin.contests')])

    <div class="osu-page osu-page--admin">
        <ul>
          @foreach ($contests as $contest)
              <li>
                  <a href="{{route('admin.contests.show', $contest->id)}}">{{ $contest->name }}</a>
              </li>
          @endforeach
        </ul>
    </div>
@endsection
