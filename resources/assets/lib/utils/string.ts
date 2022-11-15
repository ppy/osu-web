// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export function presence(value?: string | null) {
  return present(value) ? value : null;
}

export function present(value?: string | null) {
  return value != null && value !== '';
}

// Handles case where crowdin fills in untranslated key with empty string.
export function transExists(key: string, locale: string) {
  const translated = window.Lang.get(key, undefined, locale);

  return present(translated) && translated !== key;
}
