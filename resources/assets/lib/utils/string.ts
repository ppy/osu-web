// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Replacement, Replacements } from 'lang';
import { formatNumber } from './html';

export function presence(value?: string | null) {
  return present(value) ? value : null;
}

export function present(value?: string | null) {
  return value != null && value !== '';
}

export function trans(key: string, replacements: Replacements = {}, locale?: string) {
  if (!transExists) {
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

  if (!isFallbackLocale && translated != null) {
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
