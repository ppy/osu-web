{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('admin/master')

@section('content')
    <div class="osu-layout__row osu-layout__row--page-admin">
        <h1>{{ trans('admin.logs.index.title') }}</h1>

        @foreach ($logs->get() as $log)
            <p>
                <pre>{{ json_encode($log->toArray(), JSON_PRETTY_PRINT) }}</pre>
            </p>
        @endforeach
    </div>
@endsection
