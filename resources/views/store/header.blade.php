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
@php
    $action = request()->route()->getActionName();
    if ($action === App\Http\Controllers\StoreController::class.'@getListing') {
        $actionName = 'products';
    } elseif ($action === App\Http\Controllers\Store\ProductsController::class.'@show') {
        $actionName = 'product';
    } elseif ($action === App\Http\Controllers\Store\CartController::class.'@show') {
        $actionName = 'cart';
    } elseif ($action === App\Http\Controllers\Store\CheckoutController::class.'@show') {
        $actionName = 'cart';
    } elseif ($action === App\Http\Controllers\StoreController::class.'@getInvoice') {
        $actionName = 'order';
    } elseif ($action === App\Http\Controllers\Store\OrdersController::class.'@index') {
        $actionName = 'orders';
    }

    $links = [
        [
            'active' => $actionName === 'products',
            'title' => trans('layout.header.store.products'),
            'url' => route('store.products.index'),
        ],
        [
            'active' => $actionName === 'cart',
            'title' => trans('layout.header.store.cart'),
            'url' => route('store.cart.show'),
        ],
        [
            'active' => $actionName === 'orders',
            'title' => trans('layout.header.store.orders'),
            'url' => route('store.orders.index'),
        ],
    ];
@endphp

@component('layout._page_header_v4', ['params' => [
    'links' => $links,
    'section' => trans('layout.header.store._'),
    'subSection' => trans("layout.header.store.{$actionName}"),
    'theme' => 'store',
]])
    @slot('titleAppend')
        @if(isset($cart) && $cart && $cart->items()->exists())
            <a href="{{ route('store.cart.show') }}" class="btn-osu-big btn-osu-big--store-cart">
                <span class="btn-osu-big__content">
                    <span class="btn-osu-big__left">
                        {{ trans_choice('store.cart.info', $cart->getItemCount(), ['subtotal' => $cart->getSubtotal()]) }}
                    </span>

                    <span class="btn-osu-big__icon">
                        <i class="fas fa-shopping-cart"></i>
                    </span>
                </span>
            </a>
        @endif
    @endslot

    @slot('contentAppend')
        <div class="store-xsolla">
            <div class="store-xsolla__text">
                {{ trans('store.xsolla.distributor') }}
            </div>
            <div class="store-xsolla__icon"></div>
        </div>
    @endslot
@endcomponent

<div class="osu-page">
    @if (config('osu.store.notice') !== null)
        <div class="store-notice store-notice--important">
            <h2 class="store-notice__title">
                {{ trans('common.title.notice') }}
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
                trans('store.checkout.has_pending.link_text'),
                ['class' => 'link link--default']
            )
        @endphp
        <div class="store-notice">
            <span>
                {!! trans('store.checkout.has_pending._', ['link' => $pendingCheckoutLink]) !!}
            </span>
        </div>
    @endif
</div>
