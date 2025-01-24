{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('script')
    <script id="json-shopify-options" type="application/json">
        {!! json_encode([
            'domain' => $GLOBALS['cfg']['store']['shopify']['domain'],
            'storefrontAccessToken' => $GLOBALS['cfg']['store']['shopify']['storefront_token'],
        ]) !!}
    </script>

    <script id="json-shopify-storefront-options" type="application/json">
        {!! json_encode([
            'storeDomain' => $GLOBALS['cfg']['store']['shopify']['domain'],
            'apiVersion' => '2024-04',
            'publicAccessToken' => $GLOBALS['cfg']['store']['shopify']['storefront_token'],
        ]) !!}
    </script>

    @parent
    @include('layout._extra_js', ['src' => 'js/store-bootstrap.js'])
@endsection
