// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { currentUrl } from 'utils/turbolinks';
import { Ziggy } from 'ziggy';
import ziggyRoute, { RouteList } from 'ziggy-js';

// ensure correct url
const siteUrl = currentUrl();
Ziggy.port = +siteUrl.port || null; // either port number or null if empty (converted to 0)
Ziggy.url = siteUrl.origin;

type RouteName = keyof RouteList;
type Params<T extends RouteName> = Parameters<typeof ziggyRoute<T>>[1];

export function route<T extends RouteName>(name: T, params?: Params<T>, absolute?: boolean) {
  return ziggyRoute<T>(name, params, absolute, Ziggy);
}
