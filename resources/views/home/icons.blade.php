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
@extends("master")

@section("content")

    <div class="osu-layout__row osu-layout__row--page">
        <h1>Icons</h1>

        @foreach($icons as $icon)

            <div class="row">
                <div class="col-xs-7">
                    <i class="fa fa-5x fa-osu-{{ $icon }}"></i>
                    <i class="fa fa-4x fa-osu-{{ $icon }}"></i>
                    <i class="fa fa-3x fa-osu-{{ $icon }}"></i>
                    <i class="fa fa-2x fa-osu-{{ $icon }}"></i>
                    <i class="fa fa-lg fa-osu-{{ $icon }}"></i>
                    <i class="fa fa-fw fa-osu-{{ $icon }}"></i>
                </div>
                <div class="col-xs-5">
                    <h3>fa-osu-{{ $icon }}</h3>
                </div>
            </div>

        @endforeach

    </div>
@stop
