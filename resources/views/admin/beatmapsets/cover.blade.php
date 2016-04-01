{{--
    Copyright 2015 ppy Pty. Ltd.

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
    <div class="osu-layout__row osu-layout__row--page">
        <h2>{{$beatmapSet->title}} - {{$beatmapSet->artist}}</h2>
        <br>
        {!! Form::open([
            'route' => ['admin.beatmapsets.covers.regenerate', $beatmapSet->beatmapset_id],
            'method' => 'POST'
        ]) !!}
            <button>regenerate</button>
        {!! Form::close() !!}
        @foreach ($beatmapSet->coverSizes() as $size)
            <h3>{{$size}}</h3>
            <p>{{$beatmapSet->coverURL($size)}}</p>
            <img src="{{$beatmapSet->coverURL($size)}}">
            <br>
        @endforeach
    </div>
@endsection
