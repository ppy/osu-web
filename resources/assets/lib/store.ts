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

import Shopify from 'shopify-buy';
import { toShopifyVariantId } from 'shopify-gid';

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

interface LineItem {
  quantity: number;
  variantId: string;
}

export class Store {
  private static instance: Store;

  static init() {
    if (this.instance == null) {
      this.instance = new Store();
    }

    return this.instance;
  }

  private constructor() {
    $(document).on('click', '.js-store-checkout', this.beginCheckout.bind(this));
    $(document).on('click', '.js-store-resume-checkout', this.resumeCheckout.bind(this));

    $(document).on('turbolinks:load', () => {
      $('.js-store-checkout').prop('disabled', false);
    });

    $('.js-store-checkout').prop('disabled', false);
  }

  async beginCheckout(event: Event) {
    if (event.target == null) { return; }

    const orderId = osu.presence((event.target as HTMLElement).dataset.orderId);
    if (orderId == null) {
      throw new Error('orderId is missing');
    }

    const { isValid, lineItems } = this.collectShopifyItems();

    if (!isValid) {
      // can't mix Shopify and non-Shopify items.
      // This should normally not show as the button itself shouldn't have been rendered.
      osu.popup(osu.trans('model_validation/store/product.must_separate'), 'danger');

      return;
    }

    if (lineItems.length > 0) {
      return this.beginShopifyCheckout(orderId, lineItems, event.target);
    }

    Turbolinks.visit(laroute.route('store.checkout.show', { checkout: orderId }));
  }

  async beginShopifyCheckout(orderId: string, lineItems: LineItem[], target: EventTarget) {
    try {
      LoadingOverlay.show();
      LoadingOverlay.show.flush();

      // create shopify checkout.
      // error returned will be a JSON string in error.message
      const checkout = await client.checkout.create({
        customAttributes: [{ key: 'orderId', value: orderId }],
        lineItems,
      });

      const params = {
        orderId,
        provider: 'shopify',
        shopifyId: checkout.id,
      };

      // FIXME: ugly
      try {
        await osu.promisify($.post(laroute.route('store.checkout.store'), params));
        window.location = checkout.webUrl;
      } catch (error) {
        LoadingOverlay.hide();
        userVerification.showOnError({ target }, error);
      }
    } catch (error) {
      // either error from Shopify or updating the order state failed.
      // TODO: separate the handling of errors.
      osu.popup(osu.trans('errors.checkout.generic'), 'danger');
      LoadingOverlay.hide();
    }
  }

  async resumeCheckout(event: Event) {
    if (event.target == null) { return; }

    const target = event.target as HTMLElement;
    const checkoutId = osu.presence(target.dataset.checkoutId);
    if (checkoutId == null) {
      Turbolinks.visit(laroute.route('store.invoice.show', { invoice: target.dataset.orderId }));
    } else {
      this.resumeShopifyCheckout(checkoutId);
    }
  }

  async resumeShopifyCheckout(checkoutId: string) {
    LoadingOverlay.show();
    LoadingOverlay.show.flush();

    const checkout = await client.checkout.fetch(checkoutId);

    window.location = checkout.webUrl;
  }

  private collectShopifyItems() {
    let isValid = true;

    const lineItems: LineItem[] = [];
    $('.js-store-order-item').each((_, element) => {
      const id = osu.presence(element.dataset.shopifyId);
      if (id == null) {
        isValid = false;
      }

      if (id != null) {
        lineItems.push({
          quantity: Number(element.dataset.quantity),
          variantId: toShopifyVariantId(id),
        });
      }
    });

    if (lineItems.length === 0) {
      isValid = true;
    }

    return {
      isValid,
      lineItems,
    };
  }
}

window.Store = window.Store || Store.init();
