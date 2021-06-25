// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';

interface Props {
  country?: Country;
  modifiers?: string[];
}

export default function FlagCountry({country, modifiers}: Props) {
  if (country == null || country.code == null) {
    return null;
  }

  return (
    <div
      className={osu.classWithModifiers('flag-country', modifiers)}
      style={{
        backgroundImage: `url('/images/flags/${country.code}.png')`,
      }}
      title={country.name}
    />
  );
}
