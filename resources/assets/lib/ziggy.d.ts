// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare module 'ziggy' {
  export const Ziggy: {};
}

declare module 'ziggy-route' {
  export default function route(name: string, params: any, absolute?: boolean, ziggy?: {}): any;
}
