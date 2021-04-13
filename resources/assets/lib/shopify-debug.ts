// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
  const products = await fetchAllProducts();

  return products.map((x: any) => x.id);
}

export async function fetchAllVariants(): Promise<any[]> {
  const products = await fetchAllProducts();

  let variants: any[] = [];
  for (const product of products) {
    variants = variants.concat(product.variants);
  }

  return variants;
}

export async function fetchAllVariantIds(): Promise<{ }> {
  const variants = await fetchAllVariants();

  return variants.map((x: any) => ({
    gid: x.id,
    name: x.title,
  }));
}
