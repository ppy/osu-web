{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => osu_trans('layout.header.admin.beatmapset')])

@section('content')
    @include('admin/_header')
    <div class="osu-page osu-page--admin">
        <h1>{{ $beatmapset->title }} - {{ $beatmapset->artist }}</h1>

        <ul>
            <li><a href="{{ route('admin.beatmapsets.covers', $beatmapset->beatmapset_id) }}">{{ osu_trans('admin.beatmapsets.show.covers') }}</a></li>
        </ul>
    </div>
@endsection
