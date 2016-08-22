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

{{-- below check skips this whole thing if there are no images given --}}
@if (collect($mapping)->first(function ($val) { return present($val); }) !== null)
<style type='text/css'>
    @foreach ($mapping as $class => $image)
        @if (present($image))
            {{$class}} { background-image: url('{{$image}}'); }
        @endif
    @endforeach
    @media (-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (min-resolution: 1.5dppx) {
        @foreach ($mapping as $class => $image)
            @if (present($image))
                {{$class}} { background-image: url('{{retinaify($image)}}'); }
            @endif
        @endforeach
    }
</style>
@endif
