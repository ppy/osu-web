{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
@include('layout._page_header_v4', ['params' => [
    'section' => trans('layout.header.error._'),
    'subSection' => trans("layout.errors.$currentAction.error"),
    'theme' => 'default',
]])

<div class="osu-page osu-page--generic text-center">
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
