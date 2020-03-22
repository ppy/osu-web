{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
