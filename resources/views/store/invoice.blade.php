{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('store/layout', ['titlePrepend' => osu_trans('store.invoice.title_compact')])

@section('content')
    @include('store.header')

    <div class="osu-page osu-page--store">
        @if (Request::has('thanks'))
            <div class="no-print store-page">
                <h1 class="store-text store-text--title">Thanks for your order!</h1>
                <p>
                    You will receive a confirmation email soon. If you have any enquiries, please <a href='mailto:osustore@ppy.sh'>contact us</a>!
                </p>
            </div>
        @endif

        @include('store.orders._details')

        @include('store.orders._status')

        @if ($order->isShipped())
            @foreach($order->trackingCodes() as $code)
                @include('store.orders._tracking', compact('code'))
            @endforeach
        @endif
    </div>
@endsection
