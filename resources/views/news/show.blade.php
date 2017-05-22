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
    <div class="osu-page">
        <div class="osu-page-header osu-page-header--news">
            <h1 class="osu-page-header__title">
                {{ $entry->title() }}
            </h1>
        </div>
    </div>

    <div class="osu-page osu-page--generic">
        {!! $entry->bodyHtml() !!}

        <div>
            @if ($entry->navNewerId() === null)
                <span>
                    {{ trans('news.show.nav.newer') }}
                </span>
            @else
                <a href="{{ route('news.show', $entry->navNewerId()) }}">
                    {{ trans('news.show.nav.newer') }}
                </a>
            @endif
            @if ($entry->navOlderId() === null)
                <span>
                    {{ trans('news.show.nav.older') }}
                </span>
            @else
                <a href="{{ route('news.show', $entry->navOlderId()) }}">
                    {{ trans('news.show.nav.older') }}
                </a>
            @endif
        </div>
    </div>
@endsection
