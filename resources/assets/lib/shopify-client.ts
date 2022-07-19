// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Shopify from 'shopify-buy';
import { parseJson } from 'utils/json';

interface ShopifyOptions {
  domain: string;
  storefrontAccessToken: string;
}

let clientCache: any;

export default function shopifyClient() {
  if (clientCache == null) {
    const options = parseJson<ShopifyOptions>('json-shopify-options');
    clientCache = Shopify.buildClient(options);
  }

  return clientCache;
}
