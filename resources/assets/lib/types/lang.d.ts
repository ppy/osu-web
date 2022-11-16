// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import 'utils/lang';

// override lang.js Replacements type with ours.
declare module 'utils/lang' {
  interface Lang {
    choice(key: string, num: number, replacements?: Replacements, locale?: string): string;
    get(key: string, replacements?: Replacements, locale?: string): string;
    trans(key: string, replacements?: Replacements): string;
    transChoice(key: string, count: number, replacements?: Replacements): string;
  }
}
