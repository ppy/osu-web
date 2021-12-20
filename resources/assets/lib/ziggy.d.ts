// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare module 'ziggy' {
  interface ZiggyClass {
    port: number | null;
    url: string;
  }

  export const Ziggy: ZiggyClass;
}

declare module 'ziggy-route' {
  export default function route(name: string, params: any, absolute?: boolean, ziggy?: import('ziggy').ZiggyClass): string;
}
