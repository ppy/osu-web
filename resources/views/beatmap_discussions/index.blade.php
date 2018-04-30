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

{{-- FIXME: move to user modding history --}}
@section('content')
    <div class="osu-layout__row osu-layout__row--page">
        <div class="beatmapset-activities">
            @if (isset($user))
                <h2>{{ trans('users.beatmapset_activities.title', ['user' => $user->username]) }}</h2>
            @endif

            <h3>{{ trans('beatmap_discussions.index.title') }}</h3>

            <form>
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

                @if (priv_check('BeatmapDiscussionModerate')->can())
                    <div>
                        <label>
                            <input
                                type="checkbox"
                                name="with_deleted"
                                value="1"
                                {{ $search['params']['with_deleted'] ? 'checked' : '' }}
                            >

                            {{ trans('beatmap_discussions.index.form.deleted') }}
                        </label>
                    </div>
                @endif

                <input type="submit">
            </form>

            <div class="beatmap-discussions__discussion">
                @foreach ($discussions as $discussion)
                    @include('beatmap_discussions._item', compact('discussion'))
                @endforeach
            </div>

            @include('forum._pagination', ['object' => $discussions])
        </div>
    </div>
@endsection
