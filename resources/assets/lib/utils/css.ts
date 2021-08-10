// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { forEach } from 'lodash';

export type Modifiers = (string | null | undefined)[] | Partial<Record<string, boolean | null | undefined>> | string | null | undefined;

const eachModifier = (modifiersArray: Modifiers[], callback: (modifier: string) => void) => {
  modifiersArray.forEach((modifiers) => {
    if (Array.isArray(modifiers)) {
      modifiers.forEach((modifier) => {
        if (modifier != null) {
          callback(modifier);
        }
      });
    } else if (typeof modifiers === 'string') {
      callback(modifiers);
    } else {
      forEach(modifiers, (isActive, modifier) => {
        if (isActive) {
          callback(modifier);
        }
      });
    }
  });
};

export function classWithModifiers(className: string, ...modifiersArray: Modifiers[]) {
  let ret = className;

  eachModifier(modifiersArray, (m) => ret += ` ${className}--${m}`);

  return ret;
}
