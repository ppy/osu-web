{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => osu_trans('layout.header.admin.contests')])


@section('content')
    @include('admin/_header')

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
