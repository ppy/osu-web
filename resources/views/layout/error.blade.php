{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')

<div class="osu-page osu-page--generic text-center">
    <h1>{{{ trans("layout.errors.$currentAction.error") }}}</h1>

    @if (isset($exceptionMessage))
        <p>{{ $exceptionMessage }}</p>
    @endif

    <p>
        {!! trans("layout.errors.$currentAction.description", ['link' =>
            '<a class="blue_normal" href="'.trans("layout.errors.$currentAction.link.href").'">'.trans("layout.errors.$currentAction.link.text").'</a>',
        ]) !!}
    </p>

    @if (isset($ref))
        <h4>{{ trans('layout.errors.reference') }}<br><small>{{ $ref }}</small></h4>
    @endif
</div>

@stop
