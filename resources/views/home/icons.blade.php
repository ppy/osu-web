{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, version 3 of the License.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends("master")

@section("content")

    <div class="row-page"><div class="col-sm-12">
        <h1>Icons</h1>

        @foreach($icons as $icon)

            <div class="row">
                <div class="col-xs-7">
                    <i class="fa osu fa-5x fa-{{ $icon }}"></i>
                    <i class="fa osu fa-4x fa-{{ $icon }}"></i>
                    <i class="fa osu fa-3x fa-{{ $icon }}"></i>
                    <i class="fa osu fa-2x fa-{{ $icon }}"></i>
                    <i class="fa osu fa-lg fa-{{ $icon }}"></i>
                    <i class="fa osu fa-fw fa-{{ $icon }}"></i>
                </div>
                <div class="col-xs-5">
                    <h3>fa-{{ $icon }}</h3>
                </div>
            </div>

        @endforeach

    </div></div>

@stop
