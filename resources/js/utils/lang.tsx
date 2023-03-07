// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Lang from 'lang.js';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { present } from 'utils/string';

type Replacement = string | number;
export type Replacements = Partial<Record<string, Replacement>>;

export function joinComponents(array: React.ReactElement[], key = 'common.array_and') {
  const nodes: React.ReactFragment[] = [];

  if (array.length > 0) {
    nodes.push(array[0]);

    if (array.length > 1) {
      const lastIndex = array.length - 1;
      const lastConnector = lastIndex === 1 ? trans(`${key}.two_words_connector`) : trans(`${key}.last_word_connector`);
      const connector = trans(`${key}.words_connector`);

      for (let i = 1; i < lastIndex; i++) {
        nodes.push(<React.Fragment key={array[i].key}>{connector}{array[i]}</React.Fragment>);
      }

      nodes.push(<React.Fragment key={array[lastIndex].key}>{lastConnector}{array[lastIndex]}</React.Fragment>);
    }
  }

  return <>{nodes}</>;
}

export function trans(key: string, replacements: Replacements = {}, locale?: string) {
  if (!transExists(key, locale)) {
    locale = fallbackLocale;
  }

  return window.Lang.get(key, replacements, locale);
}

export function transArray(array: Replacement[], key = 'common.array_and') {
  switch (array.length) {
    case 0:
      return '';
    case 1:
      return `${array[0]}`;
    case 2:
      return array.join(trans(`${key}.two_words_connector`));
    default:
      return `${array.slice(0, -1).join(trans(`${key}.words_connector`))}${trans(`${key}.last_word_connector`)}${array.slice(-1)[0]}`;
  }
}

export function transChoice(key: string, count: number, replacements: Replacements = {}, locale?: string): string {
  locale ??= currentLocale;
  const isFallbackLocale = locale === fallbackLocale;

  if (!isFallbackLocale && !transExists(key, locale)) {
    return transChoice(key, count, replacements, fallbackLocale);
  }

  replacements.count_delimited = formatNumber(count, undefined, undefined, locale);
  const translated = window.Lang.choice(key, count, replacements, locale);

  if (!isFallbackLocale && translated == null) {
    delete replacements.count;
    return transChoice(key, count, replacements, fallbackLocale);
  }

  return translated;
}

// Handles case where crowdin fills in untranslated key with empty string.
export function transExists(key: string, locale?: string) {
  const translated = window.Lang.get(key, undefined, locale);

  return present(translated) && translated !== key;
}


// re-export Lang so we can use our version of the types;
// default export doesn't support declaration https://github.com/microsoft/TypeScript/issues/14080
export { Lang };
