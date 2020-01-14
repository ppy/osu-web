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
    @include('admin/_header', ['title' => trans('layout.header.admin.beatmapset_covers')])
    <div class="osu-page osu-page--admin">
        <div class="beatmapset-cover-admin">
            <h2>{{$beatmapset->title}} - {{$beatmapset->artist}}</h2>
            <br>
            <button
                class="btn-osu-big btn-osu-big--rounded-thin"
                data-remote="true"
                data-method="POST"
                data-url="{{ route('admin.beatmapsets.covers.regenerate', $beatmapset->beatmapset_id) }}"
                data-reload-on-success="1"
                data-disable-with="{{ trans('admin.beatmapsets.covers.regenerating') }}"
            >
                <i class="fas fa-fw fa-sync"></i>
                {{trans('admin.beatmapsets.covers.regenerate')}}
            </button>
            <button
                class="btn-osu-big btn-osu-big--rounded-thin"
                data-remote="true"
                data-method="POST"
                data-url="{{ route('admin.beatmapsets.covers.remove', $beatmapset->beatmapset_id) }}"
                data-reload-on-success="1"
                data-disable-with="{{ trans('admin.beatmapsets.covers.removing') }}"
            >
                <i class="fas fa-fw fa-trash"></i>
                {{trans('admin.beatmapsets.covers.remove')}}
            </button>
            @foreach (array_merge(['raw', 'fullsize'], $beatmapset->coverSizes()) as $size)
                <h3>{{$size}}</h3>
                <a href="{{$beatmapset->coverURL($size)}}">
                    <div>{{$beatmapset->coverURL($size)}}</div>
                    <img class="beatmapset-cover-admin__img" src="{{$beatmapset->coverURL($size)}}">
                </a>
            @endforeach
        </div>
    </div>
@endsection
