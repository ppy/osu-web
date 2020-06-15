// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { forEach } from 'lodash';

type Modifiers = (string | null | undefined)[] | Record<string, boolean | null | undefined>;

export function classWithModifiers(className: string, modifiers?: Modifiers) {
  let ret = className;

  if (modifiers != null) {
    if (Array.isArray(modifiers)) {
      modifiers.forEach((modifier) => {
        if (modifier != null) {
          ret += ` ${className}--${modifier}`;
        }
      });
    } else {
      forEach(modifiers, (isActive, modifier) => {
        if (isActive) {
          ret += ` ${className}--${modifier}`;
        }
      });
    }
  }

  return ret;
}
