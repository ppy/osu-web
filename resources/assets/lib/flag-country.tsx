// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CountryJson from 'interfaces/country-json';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';

interface Props {
  country?: CountryJson;
  modifiers?: Modifiers;
}

const flagUrl = (code: string) => {
  const baseFileName = code
    .split('')
    .map((c) => (c.charCodeAt(0) + 127397).toString(16))
    .join('-');

  return `/assets/images/flags/${baseFileName}.svg`;
};

export default function FlagCountry({ country, modifiers }: Props) {
  if (country == null || country.code == null) {
    return null;
  }

  return (
    <div
      className={classWithModifiers('flag-country', modifiers)}
      style={{
        backgroundImage: `url('${flagUrl(country.code)}')`,
      }}
      title={country.name}
    />
  );
}
