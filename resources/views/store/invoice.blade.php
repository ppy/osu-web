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
@extends('store/layout')

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

        @if ($order->status === 'shipped')
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
