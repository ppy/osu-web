// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import core from 'osu-core-singleton';
import { toShopifyVariantGid } from 'shopify-gid';
import { createClickCallback } from 'utils/html';
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay';
import client from './shopify-client';

declare global {
  interface Window {
    Store: Store;
  }
}

export class Store {
  private constructor() {
    $(document).on('click', '.js-store-checkout', this.beginCheckout.bind(this));
    $(document).on('click', '.js-store-resume-checkout', this.resumeCheckout.bind(this));

    $(document).on('turbolinks:load', () => {
      $('.js-store-checkout').prop('disabled', false);
    });

    $('.js-store-checkout').prop('disabled', false);
  }

  static init(sharedContext: Window) {
    sharedContext.Store = sharedContext.Store || new Store();
  }

  async beginCheckout(event: Event) {
    if (event.target == null) return;

    const dataset = (event.target as HTMLElement).dataset;
    const orderId = dataset.orderId;
    const shouldShopify = dataset.shopify === '1';
    if (orderId == null) {
      throw new Error('orderId is missing');
    }

    if (shouldShopify) {
      try {
        await this.beginShopifyCheckout(orderId);
      } catch (error) {
        hideLoadingOverlay();
        core.userVerification.showOnError(error, createClickCallback(event.target));
      }

      return;
    }

    Turbolinks.visit(route('store.checkout.show', { checkout: orderId }));
  }

  async beginShopifyCheckout(orderId: string) {
    showLoadingOverlay();
    showLoadingOverlay.flush();

    let checkout: any;
    try {
      // create shopify checkout.
      // error returned will be a JSON string in error.message
      checkout = await client().checkout.create({
        customAttributes: [{ key: 'orderId', value: orderId }],
        lineItems: this.collectShopifyItems(),
      });
    } catch (error) {
      hideLoadingOverlay();
      osu.popup(osu.trans('errors.checkout.generic'), 'danger');
      return;
    }

    const params = {
      orderId,
      provider: 'shopify',
      shopifyCheckoutId: checkout.id,
    };

    await osu.promisify($.post(route('store.checkout.store'), params));
    window.location.href = checkout.webUrl;
  }

  resumeCheckout(event: Event) {
    if (event.target == null) return;

    const target = event.target as HTMLElement;
    const { provider, providerReference, status } = target.dataset;

    if (provider === 'shopify' && status !== 'cancelled') {
      if (providerReference != null) {
        this.resumeShopifyCheckout(providerReference);
      } else {
        // TODO: show error.
      }
    } else {
      Turbolinks.visit(route('store.invoice.show', { invoice: target.dataset.orderId }));
    }
  }

  async resumeShopifyCheckout(checkoutId: string) {
    showLoadingOverlay();
    showLoadingOverlay.flush();

    const checkout = await client().checkout.fetch(checkoutId);
    if (checkout != null) {
      window.location.href = checkout.webUrl;
    } else {
      osu.popup(osu.trans('store.order.shopify_expired'), 'info');
      hideLoadingOverlay();
    }
  }

  private collectShopifyItems() {
    return $('.js-store-order-item').map((_, element) => ({
      quantity: Number(element.dataset.quantity),
      variantId: toShopifyVariantGid(element.dataset.shopifyId),
    })).get();
  }
}
