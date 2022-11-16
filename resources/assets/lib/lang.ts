// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Lang from 'lang.js';

export type Replacement = string | number | null | undefined;

export interface Replacements {
  [key: string]: Replacement;
}

// re-export Lang so we can use our version of the types;
// default export doesn't support declaration https://github.com/microsoft/TypeScript/issues/14080
export { Lang };
