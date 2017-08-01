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
@extends("master")

@php
    $keyPrefix = 'layout.errors.'.Route::currentRouteAction().'.'.$current_action;
    if (!Lang::has($keyPrefix)) {
        $keyPrefix = "layout.errors.{$current_action}";
    }
@endphp

@section("content")
    <div class="osu-layout__row osu-layout__row--page">
        <h1 class="text-center">{{{ trans("$keyPrefix.error") }}}</h1>

        @if (Lang::has("{$keyPrefix}.link.href"))
            {!! trans("{$keyPrefix}.description", ["link" =>
                '<a href="'.trans("{$keyPrefix}.link.href").'">'.trans("{$keyPrefix}.link.text").'</a>'
            ]) !!}
        @else
            <div class="text-center">{{ trans("{$keyPrefix}.description") }}</div>
        @endif

        @if (isset($ref))
            <h4 class="text-center">
                {{ trans("layout.errors.reference") }}
                <br>
                <small>{{ $ref }}</small>
            </h4>
        @endif
    </div>
@endsection
