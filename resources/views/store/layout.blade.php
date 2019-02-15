
@extends('master')

@section('script')
    @parent
    @include('layout._extra_js', ['src' => 'js/store.js'])
@endsection
