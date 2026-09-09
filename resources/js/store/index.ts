// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import core from 'osu-core-singleton';
import { error, isJqXHR, onError } from 'utils/ajax';
import { fail } from 'utils/fail';
import { createClickCallback } from 'utils/html';
import { trans } from 'utils/lang';
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay';
import { popup } from 'utils/popup';
import { presence } from 'utils/string';
import { createShopifyCart, getShopifyCart } from './store-shopify';
import { loadXsollaWidget, openXsollaWidget, XsollaParams } from './store-xsolla';

interface CheckoutParams {
  hide_from_activity?: boolean;
  order_id: string;
  provider: string;
  shopify_checkout_id?: string;
}

interface PaypalCheckoutResponse {
  paypal_approve_url: string;
  provider: 'paypal';
}

interface XsollaCheckoutResponse extends XsollaParams {
  provider: 'xsolla';
}

type CheckoutResponse = PaypalCheckoutResponse | XsollaCheckoutResponse;
type TriggeredEvent = JQuery.TriggeredEvent<Document, unknown, HTMLElement, HTMLElement>;

export default class Store {
  private scriptLoading?: Promise<unknown>;

  private constructor() {
    $(document).on('click', '.js-store-checkout', this.handleCheckout);
    $(document).on('click', '.js-store-resume-checkout', this.handleResumeCheckout);
    $(document).on('click', '.js-store-payment-button', this.handlePaymentClick);

    $(document).on('turbo:load', () => {
      $('.js-store-checkout').prop('disabled', false);
    });

    $('.js-store-checkout').prop('disabled', false);
  }

  static init() {
    core.store ??= new Store();
  }

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

    await this.sendCheckoutRequest({
      order_id: orderId,
      provider: 'shopify',
      shopify_checkout_id: data.cartCreate.cart.id,
    });
    window.location.href = data.cartCreate.cart.checkoutUrl;
  }

  private readonly handleCheckout = (event: TriggeredEvent) => {
    const target = event.target;
    const orderId = target.dataset.orderId ?? fail('orderId is missing');
    const shouldShopify = target.dataset.shopify === '1';

    if (!shouldShopify) {
      Turbo.visit(route('store.checkout.show', { checkout: orderId }));
      return;
    }

    this.beginShopifyCheckout(orderId).catch((err) => {
      hideLoadingOverlay();
      if (!isJqXHR(err)) throw err;
      error(err, err.statusText, createClickCallback(target));
    });
  };

  private readonly handlePaymentClick = (event: TriggeredEvent) => {
    const { orderId, provider } = event.target.dataset;
    // sanity
    if (provider == null || orderId == null) throw new Error();
    if (provider === 'xsolla') {
      this.scriptLoading = loadXsollaWidget();
    }

    this.startPayment(orderId, provider).catch((err) => {
      hideLoadingOverlay();
      if (!isJqXHR(err)) {
        const message = err instanceof Error ? err.message : null;
        popup(presence(message) ?? trans('errors.unknown'), 'danger');
        return;
      }

      if (err.getResponseHeader('content-type') === 'application/javascript') {
        return;
      }

      // TODO: less unknown error, disable button
      // TODO: handle error.message
      onError(err);
    });
  };

  private readonly handleResumeCheckout = (event: TriggeredEvent) => {
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

  private sendCheckoutRequest(params: CheckoutParams) {
    return $.post(route('store.checkout.store'), params) as JQuery.jqXHR<CheckoutResponse>;
  }

  private async startPayment(orderId: string, provider: string) {
    showLoadingOverlay();
    showLoadingOverlay.flush();

    const response = await this.sendCheckoutRequest({
      hide_from_activity: document.querySelector<HTMLInputElement>('.js-hide-from-activity')?.checked,
      order_id: orderId,
      provider,
    });

    switch (response.provider) {
      case 'paypal':
        window.location.href = response.paypal_approve_url;
        return;

      case 'xsolla':
        await (this.scriptLoading ?? fail('missing Xsolla script'));
        openXsollaWidget(response);
        hideLoadingOverlay();
        return;
    }

    // something went horribly wrong.
    throw new Error();
  }
}
