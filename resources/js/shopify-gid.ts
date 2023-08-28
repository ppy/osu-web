// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export function toShopifyProductGid(id?: string) {
  return btoa(`gid://shopify/Product/${id}`);
}

export function toShopifyVariantGid(id?: string) {
  return btoa(`gid://shopify/ProductVariant/${id}`);
}
