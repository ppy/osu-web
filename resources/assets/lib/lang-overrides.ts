// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

Lang._origGetPluralForm = Lang._getPluralForm;

// pt-br isn't in original getPluralForm so the locale needs to be
// temporarily changed to pt for the function to return correct form.
Lang._getPluralForm = (count, locale) => {
  if (locale === 'pt-br') {
    locale = 'pt';
  }

  return Lang._origGetPluralForm(count, locale);
};
