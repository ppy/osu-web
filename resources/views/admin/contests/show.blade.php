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
        <h1>Contest Entries</h1>
        <pre>{{json_encode($contest, JSON_PRETTY_PRINT)}}</pre>
        {!! Form::open([
            'route' => ['admin.contests.getZip', $contest->id],
            'method' => 'POST'
        ]) !!}
            <button>Download all entries as ZIP</button>
        {!! Form::close() !!}
        <br><br>
        <div>
            @foreach ($entries as $entry)
                <div>
                    <a href="{{route('users.show', $entry->user_id)}}">{{($entry->user ?? (new App\Models\DeletedUser))->username}}</a>:&nbsp;
                    <a download="{{$entry->original_filename}}" href="{{$entry->fileUrl()}}">{{$entry->original_filename}}</a>
                    <br><br>
                    @if ($contest->type == 'art')
                        <img src="{{$entry->fileUrl()}}" style="max-width: 500px; max-height: 500px;">
                    @endif
                    <hr>
                </div>
            @endforeach
        </div>
    </div>
@endsection
