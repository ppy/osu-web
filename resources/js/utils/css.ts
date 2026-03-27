// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import { present } from './string';

export type Modifiers = string | null | undefined;

export type ModifiersExtended = Modifiers | Modifiers[] | Partial<Record<string, boolean | null | undefined>>;

function* modifiersToStrings(modifiersArray: ModifiersExtended[]) {
  for (const modifiers of modifiersArray) {
    if (modifiers == null) {
      continue;
    }
    if (Array.isArray(modifiers)) {
      for (const modifier of modifiers) {
        if (modifier != null) {
          yield modifier;
        }
      }
    } else if (typeof modifiers === 'string') {
      yield modifiers;
    } else {
      for (const [modifier, isActive] of Object.entries(modifiers)) {
        if (isActive === true) {
          yield modifier;
        }
      }
    }
  }
}

export function classWithModifiers(className: string, ...modifiersArray: ModifiersExtended[]) {
  let ret = className;

  for (const modifier of modifiersToStrings(modifiersArray)) {
    for (const m of modifier.split(' ')) {
      if (m !== '') {
        ret += ` ${className}--${m}`;
      }
    }
  }

  return ret;
}

export function groupColour(group?: GroupJson | null) {
  return { '--group-colour': group?.colour ?? 'initial' };
}

export function mergeModifiers(...modifiersArray: ModifiersExtended[]) {
  return [...modifiersToStrings(modifiersArray)].join(' ');
}

export function urlPresence(url?: string | null) {
  // Wrapping the string with quotes and escaping the used quotes inside
  // is sufficient. Use double quote as it's easy to figure out with
  // encodeURI (it doesn't escape single quote).
  return present(url) ? `url("${String(url).replace(/"/g, '%22')}")` : undefined;
}

export function varBgDefault(id?: number | null) {
  return `var(--bg-default-${(id ?? 0) % 6})`;
}
