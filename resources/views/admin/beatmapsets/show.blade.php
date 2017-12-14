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
        <h1>{{ $beatmapset->title }} - {{ $beatmapset->artist }}</h1>

        <ul>
            <li>{{ trans('admin.beatmapsets.show.discussion._') }}:
                @if ($beatmapset->discussion_enabled)
                    {{ trans('admin.beatmapsets.show.discussion.active') }}
                @else
                    {{ trans('admin.beatmapsets.show.discussion.inactive') }}
                    /
                    <a
                        href="{{ route('admin.beatmapsets.update', [
                            'beatmapsets' => $beatmapset->getKey(),
                            'beatmapset[discussion_enabled]=1'
                        ]) }}"
                        data-method="PUT"
                        data-confirm="{{ trans('admin.beatmapsets.show.discussion.activate_confirm') }}"
                    >{{ trans('admin.beatmapsets.show.discussion.activate') }}</a>
                @endif
            </li>
            <li><a href="{{ route('admin.beatmapsets.covers', $beatmapset->beatmapset_id) }}">{{ trans('admin.beatmapsets.show.covers') }}</a></li>
        </ul>
    </div>
@endsection
