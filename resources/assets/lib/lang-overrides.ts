Lang._origGetPluralForm = Lang._getPluralForm;

// pt-br isn't in original getPluralForm so the locale needs to be
// temporarily changed to pt for the function to return correct form.
Lang._getPluralForm = (count) => {
  const origLocale = Lang.locale;

  if (origLocale === 'pt-br') {
    Lang.locale = 'pt';
  }

  const form = Lang._origGetPluralForm(count);

  Lang.locale = origLocale;

  return form;
};
