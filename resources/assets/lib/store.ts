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

// process.env.$ has to be static as it is injected by webpack at compile time.
const options = {
  domain: process.env.SHOPIFY_DOMAIN,
  storefrontAccessToken: process.env.SHOPIFY_TOKEN,
};

const client = Shopify.buildClient(options);

window.ShopifyClient = client;

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

  static decodeShopifyId(base64: string) {
    return atob(base64);
  }

  static encodeShopifyId(str: string) {
    return btoa(str);
  }

  static toShopifyProductId(id: string) {
    return `gid://shopify/Product/${id}`;
  }

  static toShopifyVariantId(id: string) {
    return `gid://shopify/ProductVariant/${id}`;
  }

  private constructor() {
    $(document).on('click', '.js-store-checkout', this.beginCheckout.bind(this));
    $(document).on('click', '.js-store-shopify-checkout', this.resumeShopifyCheckout.bind(this));
  }

  async beginCheckout(event: Event) {
    if (event.target == null) { return event.preventDefault(); }

    const orderId = osu.presence((event.target as HTMLElement).dataset.orderId);
    if (orderId == null) {
      throw new Error('orderId is missing');
    }

    const { isValid, lineItems } = this.collectShopifyItems();

    if (!isValid) {
      // can't mix Shopify and non-Shopify items.
      osu.popup('These items can\'t be checked out together', 'danger');

      return event.preventDefault();
    }

    if (lineItems.length > 0) {
      event.preventDefault();
      return this.beginShopifyCheckout(orderId, lineItems);
    }
  }

  async beginShopifyCheckout(orderId: string, lineItems: LineItem[]) {
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

      await osu.promisify($.post(laroute.route('store.checkout.store'), params));

      window.location = checkout.webUrl;
    } catch (error) {
      osu.popup('TODO: handle different error messages', 'danger');
      LoadingOverlay.hide();
    }
  }

  async resumeShopifyCheckout(event: Event) {
    event.preventDefault();
    if (event.target == null) { return; }

    LoadingOverlay.show();
    LoadingOverlay.show.flush();

    const checkoutId = osu.presence((event.target as HTMLElement).dataset.checkoutId);
    const checkout = await client.checkout.fetch(checkoutId);

    window.location = checkout.webUrl;
  }

  // debug helpers
  fetchAllProducts(): Promise<any[]> {
    return client.product.fetchAll();
  }

  async fetchAllProductIds(): Promise<string[]> {
    const products = await this.fetchAllProducts();

    return products.map((x) => Store.decodeShopifyId(x.id));
  }

  async fetchAllVariants(): Promise<any[]> {
    const products = await this.fetchAllProducts();

    let variants: any[] = [];
    for (const product of products) {
      variants = variants.concat(product.variants);
    }

    return variants;
  }

  async fetchAllVariantIds(): Promise<{ }> {
    const variants = await this.fetchAllVariants();

    return variants.map((x) => {
      return {
        id: Store.decodeShopifyId(x.id),
        name: x.title,
      };
    });
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
          variantId: Store.encodeShopifyId(Store.toShopifyVariantId(id)),
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

window.Store = Store.init();
