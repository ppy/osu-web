// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Lang from 'lang.js';

// pt-br isn't in original getPluralForm so the locale needs to be
// temporarily changed to pt for the function to return correct form.
function getPluralForm(count: number, locale: string) {
  if (locale === 'pt-br') {
    locale = 'pt';
  }

  return this._origGetPluralForm(count, locale); // eslint-disable-line
}

export function patchPluralHandler(lang: Lang) {
  /* eslint-disable */
  // Monkey patches original class
  // @ts-ignore
  lang._origGetPluralForm = lang._getPluralForm;
  // @ts-ignore
  lang._getPluralForm = getPluralForm;
  /* eslint-enable */

  return lang;
}
