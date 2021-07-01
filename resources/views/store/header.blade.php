{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    switch (request()->route()->getName()) {
        case 'store.products.index':
            $currentNav = 'products';
            break;
        case 'store.products.show':
            $currentNav = 'product';
            break;
        case 'store.cart.show':
            $currentNav = 'cart';
            break;
        case 'store.checkout.show':
            $currentNav = 'cart';
            break;
        case 'store.invoice.show':
            $currentNav = 'order';
            break;
        case 'store.orders.index':
            $currentNav = 'orders';
            break;
    }

    $links = [
        [
            'active' => $currentNav === 'products' || $currentNav === 'product',
            'title' => osu_trans('layout.header.store.products'),
            'url' => route('store.products.index'),
        ],
        [
            'active' => $currentNav === 'cart',
            'title' => osu_trans('layout.header.store.cart'),
            'url' => route('store.cart.show'),
        ],
        [
            'active' => $currentNav === 'orders' || $currentNav === 'order',
            'title' => osu_trans('layout.header.store.orders'),
            'url' => route('store.orders.index'),
        ],
    ];
@endphp

@component('layout._page_header_v4', ['params' => [
    'links' => $links,
    'theme' => 'store',
]])
    @slot('titleAppend')
        <div class="store-xsolla">
            <div class="store-xsolla__text">
                {!! osu_trans('store.xsolla.distributor') !!}
            </div>
            <div class="store-xsolla__icon"></div>
        </div>
    @endslot

    @slot('navAppend')
        @if(isset($cart) && $cart && $cart->items()->exists())
            <a href="{{ route('store.cart.show') }}" class="btn-osu-big btn-osu-big--store-cart">
                <span class="btn-osu-big__content">
                    <span class="btn-osu-big__left">
                        {{ osu_trans_choice('store.cart.info', $cart->getItemCount(), ['subtotal' => $cart->getSubtotal()]) }}
                    </span>

                    <span class="btn-osu-big__icon">
                        <i class="fas fa-shopping-cart"></i>
                    </span>
                </span>
            </a>
        @endif
    @endslot
@endcomponent

<div class="osu-page no-print">
    @if (config('osu.store.notice') !== null)
        <div class="store-notice store-notice--important">
            <h2 class="store-notice__title">
                {{ osu_trans('common.title.notice') }}
            </h2>

            {!! markdown(config('osu.store.notice')) !!}
        </div>
    @endif

    {{-- TODO: make nicer --}}
    {{-- Show message if there is a pending checkout and not currently on a checkout page --}}
    @if(isset($pendingCheckout) && optional(request()->route())->getName() !== 'store.checkout.show')
        @php
            $pendingCheckoutLink = Html::link(
                route('store.orders.index', ['type' => 'processing']),
                osu_trans('store.checkout.has_pending.link_text')
            )
        @endphp
        <div class="store-notice">
            <span>
                {!! osu_trans('store.checkout.has_pending._', ['link' => $pendingCheckoutLink]) !!}
            </span>
        </div>
    @endif
</div>
