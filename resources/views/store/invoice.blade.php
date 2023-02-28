{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('store/layout', ['titlePrepend' => osu_trans('store.invoice.title_compact')])

@section('content')
    @include('store.header')

    <div class="osu-page osu-page--store">
        @if (Request::has('thanks'))
            <div class="grid grid--gutters no-print store-page">
                <div class="grid-cell grid-cell--fill">
                    <h1 class="store-text store-text--title">Thanks for your order!</h1>
                    <p>
                        You will receive a confirmation email soon. If you have any enquiries, please <a href='mailto:osustore@ppy.sh'>contact us</a>!
                    </p>
                </div>
            </div>
        @endif

        @for ($i = 0; $i < $copies; $i++)
            @if ($i > 0)
                <div class='print-page-break'></div>
            @endif

            @include('store.orders._details')
        @endfor

        @include('store.orders._status')

        @if ($order->isShipped())
            @foreach($order->trackingCodes() as $code)
                @include('store.orders._tracking', compact('code'))
            @endforeach
        @endif
    </div>

    @if ($copies > 1)
        <script>
            (() => {
                const close = () => window.close();
                const printAndClose = () => {
                    window.print();
                    setTimeout(close, 2000);
                };
                const onLoad = () => setTimeout(printAndClose, 2000);

                window.addEventListener('load', onLoad);
            })();
        </script>
    @endif
@endsection
