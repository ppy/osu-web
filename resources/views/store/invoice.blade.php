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
                <h1 class="store-text store-text--title">{{ osu_trans('store.order.thanks.title') }}</h1>
                <p>
                    {!! osu_trans('store.order.thanks.line_1._', [
                        'link' => link_to('mailto:osustore@ppy.sh', osu_trans('store.order.thanks.line_1.link_text')),
                    ]) !!}
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
