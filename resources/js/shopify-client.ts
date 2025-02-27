// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createStorefrontApiClient } from '@shopify/storefront-api-client';
import { parseJson } from 'utils/json';

interface ShopifyStorefrontOptions {
  apiVersion: string;
  publicAccessToken: string;
  storeDomain: string;
}

export default function storefrontClient() {
  const options = parseJson<ShopifyStorefrontOptions>('json-shopify-storefront-options');

  return createStorefrontApiClient(options);
}
