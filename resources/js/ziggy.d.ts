// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare module 'ziggy' {
  import route, { RouteList } from 'ziggy-js';

  export const Ziggy: NonNullable<Parameters<typeof route<keyof RouteList>>[3]>;
}
