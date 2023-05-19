// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ValueDisplay from 'components/value-display';
import UserStatisticsJson from 'interfaces/user-statistics-json';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

function formatNumberRounded(value: number) {
  return formatNumber(Math.round(value));
}

export default function Pp({ stats }: { stats: UserStatisticsJson }) {
  let extraTooltip = '';
  let extraTooltipHoverable = '0';

  (stats.variants ?? []).forEach((variant) => {
    const name = trans(`beatmaps.variant.${variant.mode}.${variant.variant}`);
    const value = formatNumberRounded(variant.pp);

    extraTooltip += `<div>${name}: ${value}</div>`;
  });
  if (stats.pp_exp !== 0 && window.experimentalHost != null) {
    const experimentalUrl = new URL(window.location.href);
    experimentalUrl.host = window.experimentalHost;
    extraTooltip += `<div>
      pp<sup>next</sup>:
      <a href="${experimentalUrl.toString()}">
        ${formatNumberRounded(stats.pp_exp)}
      </a>
    </div>`;
    extraTooltipHoverable = '1';
  }

  return (
    <ValueDisplay
      label='pp'
      modifiers='plain'
      value={(
        <div
          data-html-title={extraTooltip}
          data-tooltip-hoverable={extraTooltipHoverable}
          title=''
        >
          {formatNumberRounded(stats.pp)}
        </div>
      )}
    />
  );
}
