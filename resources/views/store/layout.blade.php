{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('script')
    @parent
    @include('layout._extra_js', ['src' => 'js/store-bootstrap.js'])
@endsection
