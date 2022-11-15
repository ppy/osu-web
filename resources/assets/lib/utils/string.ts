// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { formatNumber } from './html';

export function presence(value?: string | null) {
  return present(value) ? value : null;
}

export function present(value?: string | null) {
  return value != null && value !== '';
}

export function transChoice(key: string, count: number, replacements: Record<string, string> = {}, locale?: string): string {
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
export function transExists(key: string, locale: string) {
  const translated = window.Lang.get(key, undefined, locale);

  return present(translated) && translated !== key;
}
