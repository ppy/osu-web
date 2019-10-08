/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { route } from 'laroute';
import Shopify from 'shopify-buy';
import { toShopifyVariantGid } from 'shopify-gid';

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
    if (event.target == null) { return; }

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
        userVerification.showOnError({ target: event.target }, error);
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

  async resumeCheckout(event: Event) {
    if (event.target == null) { return; }

    const target = event.target as HTMLElement;
    const { provider, providerReference } = target.dataset;

    if (provider === 'shopify') {
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

    window.location.href = checkout.webUrl;
  }

  private collectShopifyItems() {
    return $('.js-store-order-item').map((_, element) => {
      return {
        quantity: Number(element.dataset.quantity),
        variantId: toShopifyVariantGid(element.dataset.shopifyId),
      };
    }).get();
  }
}
