{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('admin/master')

@section('content')
    <div class="osu-page osu-page--generic">
        <div class="beatmapset-cover-admin">
            <h2>{{$beatmapset->title}} - {{$beatmapset->artist}}</h2>
            <br>
            <button
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
