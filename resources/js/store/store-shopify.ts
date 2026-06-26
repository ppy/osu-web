// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createStorefrontApiClient } from '@shopify/storefront-api-client';
import { fail } from 'utils/fail';
import { parseJson } from 'utils/json';
import { present } from 'utils/string';

interface ShopifyStorefrontOptions {
  apiVersion: string;
  publicAccessToken: string;
  storeDomain: string;
}

const createCartGraphql = `
  mutation CreateCart($input: CartInput) {
    cartCreate(input: $input) {
      cart {
        id
        checkoutUrl
        lines(first: 10) {
          edges {
            node {
              id
              merchandise {
                ... on ProductVariant {
                  id
                  title
                }
              }
            }
          }
        }
        cost {
          totalAmount {
            amount
            currencyCode
          }
        }
      }
    }
  }
`;

const getCartGraphql = `
  query ($cartId: ID!) {
    cart(id: $cartId) {
      id
      checkoutUrl
      attributes {
        key
        value
      }
    }
  }
`;

export function createShopifyCart(orderId: string, elements: HTMLElement[]) {
  const input = {
    attributes: [{ key: 'orderId', value: orderId }],
    lines: elements.map((element) => ({
      merchandiseId: toShopifyVariantGid(element.dataset.shopifyId),
      quantity: Number(element.dataset.quantity),
    })),
  };

  return storefrontClient().request(createCartGraphql, { variables: { input } });
}

export function getShopifyCart(cartId: string) {
  return storefrontClient().request(getCartGraphql, { variables: { cartId } });
}

export function storefrontClient() {
  const options = parseJson<ShopifyStorefrontOptions>('json-shopify-storefront-options');

  return createStorefrontApiClient(options);
}

function toShopifyVariantGid(id?: string) {
  return present(id) ? btoa(`gid://shopify/ProductVariant/${id}`) : fail('missing variant id');
}
