// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import { forEach } from 'lodash';
import { present } from './string';

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

export function groupColour(group?: GroupJson | null) {
  return { '--group-colour': group?.colour ?? 'initial' };
}

export function mergeModifiers(...modifiersArray: Modifiers[]) {
  const ret: string[] = [];

  eachModifier(modifiersArray, (m) => ret.push(m));

  return ret;
}

export function urlPresence(url?: string | null) {
  // Wrapping the string with quotes and escaping the used quotes inside
  // is sufficient. Use double quote as it's easy to figure out with
  // encodeURI (it doesn't escape single quote).
  return present(url) ? `url("${String(url).replace(/"/g, '%22')}")` : undefined;
}

