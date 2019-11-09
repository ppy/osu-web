{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('admin/master', [
    'title' => 'Contests Admin',
])


@section('content')
    <div class="osu-layout__row osu-layout__row--page-admin">
        <h1>Contests</h1>

        <ul>
          @foreach ($contests as $contest)
              <li>
                  <a href="{{route('admin.contests.show', $contest->id)}}">{{ $contest->name }}</a>
              </li>
          @endforeach
        </ul>
    </div>
@endsection
