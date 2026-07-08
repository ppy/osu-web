// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { error, isJqXHR, onError } from 'utils/ajax';
import { fail } from 'utils/fail';
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
    $(document).on('click', '.js-store-checkout', this.beginCheckout);
    $(document).on('click', '.js-store-resume-checkout', this.resumeCheckout);
    $(document).on('click', '.js-store-payment-button', this.handlePaymentClick);

    $(document).on('turbo:load', () => {
      $('.js-store-checkout').prop('disabled', false);
    });

    $('.js-store-checkout').prop('disabled', false);
  }

  static init() {
    window.Store ??= new Store();
  }

  private readonly beginCheckout = async (event: TriggeredEvent) => {
    const target = event.target;
    const orderId = target.dataset.orderId ?? fail('orderId is missing');
    const shouldShopify = target.dataset.shopify === '1';

    if (!shouldShopify) {
      Turbo.visit(route('store.checkout.show', { checkout: orderId }));
      return;
    }

    try {
      await this.beginShopifyCheckout(orderId);
    } catch (err) {
      hideLoadingOverlay();
      if (!isJqXHR(err)) throw err;
      error(err, err.statusText, createClickCallback(target));
    }
  };

  private async beginShopifyCheckout(orderId: string) {
    showLoadingOverlay();
    showLoadingOverlay.flush();
    // create shopify checkout.
    // error returned will be a JSON string in error.message
    const response = await createShopifyCart(orderId, Array.from(document.querySelectorAll('.js-store-order-item')));
    const data = response.data;

    if (response.errors != null || data?.cartCreate.cart == null) {
      hideLoadingOverlay();
      popup(trans('errors.checkout.generic'), 'danger');
      return;
    }

    const params = {
      order_id: orderId,
      provider: 'shopify',
      shopify_checkout_id: data.cartCreate.cart.id,
    };

    await $.post(route('store.checkout.store'), params);
    window.location.href = data.cartCreate.cart.checkoutUrl;
  }

  private readonly handlePaymentClick = async (event: TriggeredEvent) => {
    const { orderId, orderNumber, provider } = event.target.dataset;
    // sanity
    if (provider == null || orderId == null) throw new Error();
    showLoadingOverlay();
    showLoadingOverlay.flush();

    if (provider === 'xsolla') {
      if (orderNumber == null) throw new Error('missing orderNumber');
      await initXsolla(orderNumber);
    }

    try {
      await $.post(route('store.checkout.store'), {
        hide_from_activity: document.querySelector<HTMLInputElement>('.js-hide-from-activity')?.checked,
        order_id: orderId,
        provider,
      });
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
  };

  private readonly resumeCheckout = (event: TriggeredEvent) => {
    const cartId = event.target.dataset.providerReference ?? fail('cartId is missing');
    this.resumeShopifyCheckout(cartId);
  };

  private async resumeShopifyCheckout(cartId: string) {
    showLoadingOverlay();
    showLoadingOverlay.flush();
    const response = await getShopifyCart(cartId);
    const data = response.data;

    if (response.errors != null || data == null) {
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
