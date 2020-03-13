{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('store/layout')

@section('content')
    @include('store.header')

    <div class="osu-page">
        <div class="store-products">
            @foreach($products as $product)
                @include('store._product', ['product' => $product])
            @endforeach
        </div>
    </div>
@endsection
