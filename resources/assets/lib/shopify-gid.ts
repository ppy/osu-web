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

export function decodeShopifyId(base64: string) {
  return atob(base64);
}

export function encodeShopifyId(str: string) {
  return btoa(str);
}

export function toShopifyProductId(id: string) {
  return encodeShopifyId(`gid://shopify/Product/${id}`);
}

export function toShopifyVariantId(id: string) {
  return encodeShopifyId(`gid://shopify/ProductVariant/${id}`);
}
