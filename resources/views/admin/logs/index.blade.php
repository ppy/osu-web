{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => osu_trans('admin.logs.index.title')])

@section('content')
    @include('admin/_header')

    <div class="osu-page osu-page--admin">
        @foreach ($logs->get() as $log)
            <p>
                <pre>{{ json_encode($log->toArray(), JSON_PRETTY_PRINT) }}</pre>
            </p>
        @endforeach
    </div>
@endsection
