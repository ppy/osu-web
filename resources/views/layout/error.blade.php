{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
@include('layout._page_header_v4', ['params' => [
    'theme' => 'error',
]])

<div class="osu-page osu-page--generic text-center">
    <p>
        {{ osu_trans("layout.errors.{$statusCode}.error") }}
    </p>

    @if (isset($exceptionMessage))
        <p>{{ $exceptionMessage }}</p>
    @endif

    <p>
        {!! osu_trans("layout.errors.{$statusCode}.description", ['link' =>
            '<a class="blue_normal" href="'.osu_trans("layout.errors.{$statusCode}.link.href").'">'.osu_trans("layout.errors.{$statusCode}.link.text").'</a>',
        ]) !!}
    </p>

    @if (isset($ref))
        <h4>{{ osu_trans('layout.errors.reference') }}<br><small>{{ $ref }}</small></h4>
    @endif
</div>

@stop
