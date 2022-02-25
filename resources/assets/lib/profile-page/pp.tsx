// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ValueDisplay from 'components/value-display';
import UserStatisticsJson from 'interfaces/user-statistics-json';
import * as React from 'react';

function formatNumber(value: number) {
  return osu.formatNumber(Math.round(value));
}

export default function Pp({ stats }: { stats: UserStatisticsJson }) {
  let variantTooltip = '';

  (stats.variants ?? []).forEach((variant) => {
    const name = osu.trans(`beatmaps.variant.${variant.mode}.${variant.variant}`);
    const value = formatNumber(variant.pp);

    variantTooltip += `<div>${name}: ${value}</div>`;
  });

  return (
    <ValueDisplay
      label='pp'
      modifiers='pp'
      value={(
        <div data-html-title={variantTooltip} title=''>
          {formatNumber(stats.pp)}
        </div>
      )}
    />
  );
}
