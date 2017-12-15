{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
        <div>
            <h3>{{ trans('admin.beatmap_discussions.index.title') }}</h3>

            <form>
                <div>
                    <label>
                        {{ trans('admin.beatmap_discussions.index.form.user.label') }}
                        <input name="user" value="{{ $search['params']['user'] }}">
                    </label>

                    @if (present($search['params']['user']))
                        <a href="{{ route('admin.beatmapset-activities.index', $search['params']['user']) }}">
                            {{ trans('admin.beatmap_discussions.index.form.user.overview') }}
                        </a>
                    @endif
                </div>

                <div>
                    @foreach (array_keys(App\Models\BeatmapDiscussion::MESSAGE_TYPES) as $type)
                        <label>
                            <input
                                type="checkbox"
                                name="message_types[]"
                                value="{{ $type }}"
                                {{ in_array($type, $search['params']['message_types'], true) ? 'checked' : '' }}
                            >
                            {{ $type }}
                        </label>
                    @endforeach
                </div>

                <div>
                    <label>
                        <input
                            type="checkbox"
                            name="with_deleted"
                            value="1"
                            {{ $search['params']['with_deleted'] ? 'checked' : '' }}
                        >

                        {{ trans('admin.beatmap_discussions.index.form.deleted') }}
                    </label>
                </div>

                <input type="submit">
            </form>

            @foreach ($discussions as $discussion)
                <p>
                    @include('admin.beatmap_discussions._item', compact('discussion'))
                </p>
            @endforeach

            @include('forum._pagination', ['object' => $discussions])
        </div>
    </div>
@endsection
