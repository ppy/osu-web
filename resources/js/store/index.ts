// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Cart, CartCreatePayload } from '@shopify/hydrogen-react/storefront-api-types';
import { route } from 'laroute';
import { error, isJqXHR, onError } from 'utils/ajax';
import { createClickCallback } from 'utils/html';
import { trans } from 'utils/lang';
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay';
import { popup } from 'utils/popup';
import { fetchApprovalLink } from './store-paypal';
import { createShopifyCart, getShopifyCart } from './store-shopify';
import { initXsolla } from './store-xsolla';

declare global {
  interface Window {
    Store?: Store;
  }
}

type TriggeredEvent = JQuery.TriggeredEvent<Document, unknown, HTMLElement, HTMLElement>;

export default class Store {
  private constructor() {
    $(document).on('click.store', '.js-store-checkout', (event: TriggeredEvent) => void this.beginCheckout(event));
    $(document).on('click.store', '.js-store-resume-checkout', (event: TriggeredEvent) => this.resumeCheckout(event));
    $(document).on('click.store', '.js-store-payment-button', (event: TriggeredEvent) => void this.handlePaymentClick(event));

    $(document).on('turbo:load', () => {
      $('.js-store-checkout').prop('disabled', false);
    });

    $('.js-store-checkout').prop('disabled', false);
  }

  static init() {
    window.Store ??= new Store();
  }

  private async beginCheckout(event: TriggeredEvent) {
    if (event.target == null) return;

    const dataset = event.target.dataset;
    const orderId = dataset.orderId;
    const shouldShopify = dataset.shopify === '1';
    if (orderId == null) {
      throw new Error('orderId is missing');
    }

    if (!shouldShopify) {
      Turbo.visit(route('store.checkout.show', { checkout: orderId }));
      return;
    }

    try {
      await this.beginShopifyCheckout(orderId);
    } catch (err) {
      hideLoadingOverlay();
      if (!isJqXHR(err)) throw err;
      error(err, err.statusText, createClickCallback(event.target));
    }
  }

  private async beginShopifyCheckout(orderId: string) {
    showLoadingOverlay();
    showLoadingOverlay.flush();
    // create shopify checkout.
    // error returned will be a JSON string in error.message
    const response = await createShopifyCart(orderId, Array.from(document.querySelectorAll('.js-store-order-item')));
    const data = response.data as { cartCreate: CartCreatePayload };

    if (response.errors != null || data.cartCreate.cart == null) {
      hideLoadingOverlay();
      popup(trans('errors.checkout.generic'), 'danger');
      return;
    }

    const params = {
      orderId,
      provider: 'shopify',
      shopifyCheckoutId: data.cartCreate.cart.id,
    };

    await $.post(route('store.checkout.store'), params);
    window.location.href = data.cartCreate.cart.checkoutUrl;
  }

  private async handlePaymentClick(event: TriggeredEvent) {
    const { orderId, orderNumber, provider } = event.target.dataset;
    // sanity
    if (provider == null || orderId == null) throw new Error();
    showLoadingOverlay();
    showLoadingOverlay.flush();

    if (provider === 'xsolla') {
      if (orderNumber == null) throw new Error('missing orderNumber');
      await initXsolla(orderNumber);
    }

    const hide_from_activity = document.querySelector<HTMLInputElement>('.js-hide-from-activity')?.checked;
    await $.post(route('store.checkout.store'), { hide_from_activity, orderId, provider });
    try {
      switch (provider) {
        case 'paypal': {
          const link = await fetchApprovalLink(orderId);
          window.location.href = link;
          break;
        }
        case 'xsolla':
          // FIXME: flickering when transitioning to widget
          window.XPayStationWidget.open();
          hideLoadingOverlay();
          break;
      }
    } catch (err) {
      hideLoadingOverlay();
      if (!isJqXHR(err)) {
        popup(trans('errors.unknown'), 'danger');
        return;
      }

      if (err.getResponseHeader('content-type') === 'application/javascript') {
        return;
      }

      // TODO: less unknown error, disable button
      // TODO: handle error.message
      onError(err);
    }
  }

  private resumeCheckout(event: TriggeredEvent) {
    const cartId = event.target.dataset.providerReference;
    if (cartId == null) throw new Error('cartId is missing');
    this.resumeShopifyCheckout(cartId);
  }

  private async resumeShopifyCheckout(cartId: string) {
    showLoadingOverlay();
    showLoadingOverlay.flush();
    const response = await getShopifyCart(cartId);
    const data = response.data as { cart?: Cart };

    if (response.errors != null || data.cart == null) {
      hideLoadingOverlay();
      popup(trans('errors.checkout.generic'), 'danger');
      return;
    }

    if (data.cart == null) {
      popup(trans('store.order.shopify_expired'), 'info');
      hideLoadingOverlay();
    } else {
      window.location.href = data.cart.checkoutUrl;
    }
  }
}
