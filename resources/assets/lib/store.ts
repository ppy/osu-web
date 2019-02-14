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
    $(document).on('click', '.js-store-checkout', this.beginCheckout);
  }

  async beginCheckout(event: Event) {
    event.preventDefault();
    if (event.target == null) { return; }

    const orderId = (event.target as HTMLElement).dataset.orderId;

    // create shopify checkout.
    let checkout = await client.checkout.create();
    console.log(checkout.id);

    const params = {
      orderId,
      provider: 'shopify',
      shopifyId: checkout.id,
    };

    const result = await osu.promisify($.post(laroute.route('store.checkout.store'), params));
    console.log(result);

    const lineItems = $('.js-store-order-item').map((_, element) => {
      // FIXME: handle the ones with no id.
      return {
        quantity: Number(element.dataset.quantity),
        variantId: Store.encodeShopifyId(Store.toShopifyVariantId(element.dataset.shopifyId || '')),
      };
    }).toArray();

    console.log(lineItems);
    checkout = await client.checkout.addLineItems(checkout.id, lineItems);
    console.log(`Redirecting to ${checkout.webUrl}`);

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
}

window.Store = Store.init();
