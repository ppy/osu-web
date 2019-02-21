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

/**
 * Dev helpers for looking up Shopify stuff.
 * import them somewhere if you need them.
 */

import Shopify from 'shopify-buy';

const options = {
  domain: process.env.SHOPIFY_DOMAIN,
  storefrontAccessToken: process.env.SHOPIFY_STOREFRONT_TOKEN,
};

const client = Shopify.buildClient(options);

export async function fetchAllProducts(): Promise<any[]> {
  return client.product.fetchAll();
}

export async function fetchAllProductIds(): Promise<string[]> {
  const products = await this.fetchAllProducts();

  return products.map((x: any) => x.id);
}

export async function fetchAllVariants(): Promise<any[]> {
  const products = await this.fetchAllProducts();

  let variants: any[] = [];
  for (const product of products) {
    variants = variants.concat(product.variants);
  }

  return variants;
}

export async function fetchAllVariantIds(): Promise<{ }> {
  const variants = await this.fetchAllVariants();

  return variants.map((x: any) => {
    return {
      gid: x.id,
      name: x.title,
    };
  });
}
