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

window.Store = new Store();
