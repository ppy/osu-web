// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { currentUrl } from 'utils/turbolinks';
import { Ziggy } from 'ziggy';
import ziggyRoute from 'ziggy-route';

// ensure correct url
const siteUrl = currentUrl();
Ziggy.port = +siteUrl.port || null; // either port number or null if empty (converted to 0)
Ziggy.url = siteUrl.origin;

export function route(name: string, params?: Partial<Record<string, string | number | null>> | null, absolute?: boolean) {
  return ziggyRoute(name, params ?? {}, absolute, Ziggy).toString();
}
