// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import core from 'osu-core-singleton';
import Shopify from 'shopify-buy';
import { toShopifyVariantGid } from 'shopify-gid';
import { createClickCallback } from 'utils/html';

declare global {
  interface Window {
    Store: Store;
  }
}

// process.env.$ has to be static as it is injected by webpack at compile time.
const options = {
  domain: process.env.SHOPIFY_DOMAIN,
  storefrontAccessToken: process.env.SHOPIFY_STOREFRONT_TOKEN,
};

const client = Shopify.buildClient(options);

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
        LoadingOverlay.hide();
        core.userVerification.showOnError(error, createClickCallback(event.target));
      }

      return;
    }

    Turbolinks.visit(route('store.checkout.show', { checkout: orderId }));
  }

  async beginShopifyCheckout(orderId: string) {
    LoadingOverlay.show();
    LoadingOverlay.show.flush();

    let checkout: any;
    try {
      // create shopify checkout.
      // error returned will be a JSON string in error.message
      checkout = await client.checkout.create({
        customAttributes: [{ key: 'orderId', value: orderId }],
        lineItems: this.collectShopifyItems(),
      });
    } catch (error) {
      LoadingOverlay.hide();
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
    LoadingOverlay.show();
    LoadingOverlay.show.flush();

    const checkout = await client.checkout.fetch(checkoutId);
    if (checkout != null) {
      window.location.href = checkout.webUrl;
    } else {
      osu.popup(osu.trans('store.order.shopify_expired'), 'info');
      LoadingOverlay.hide();
    }
  }

  private collectShopifyItems() {
    return $('.js-store-order-item').map((_, element) => ({
      quantity: Number(element.dataset.quantity),
      variantId: toShopifyVariantGid(element.dataset.shopifyId),
    })).get();
  }
}
