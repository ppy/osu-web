// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare module 'ziggy' {
  // Reduced version of unexported ziggy Config for typing when setting the port and url.
  // Using Parameters<typeof route>[3] doesn't quite work since route has overloaded parameters.
  interface ZiggyGlobal {
    port: number | null;
    url: string;
  }

  export const Ziggy: ZiggyGlobal;
}
