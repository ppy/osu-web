// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as d3 from 'd3';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface DonutChartSlice {
  colour: string;
  key: string;
  value: number;
}

interface Props {
  slices: DonutChartSlice[];
}

export default function DonutChart({ slices }: Props) {
  const visibleSlices = slices.filter((slice) => slice.value > 0);
  const isEmpty = visibleSlices.length === 0;
  const pieSlices = isEmpty
    ? [{ colour: '', key: 'empty', value: 1 }]
    : visibleSlices;

  const pie = d3.pie<DonutChartSlice>()
    .sortValues(null)
    .padAngle(visibleSlices.length > 1 ? 0.02 : 0)
    .value((slice) => slice.value);

  const arc = d3.arc<d3.PieArcDatum<DonutChartSlice>>()
    .innerRadius(50)
    .outerRadius(100)
    .cornerRadius(5);

  return (
    <svg aria-hidden='true' className='donut-chart' viewBox='0 0 200 200'>
      <g transform='translate(100, 100)'>
        {pie(pieSlices).map((datum) => (
          <path
            key={datum.data.key}
            className={classWithModifiers('donut-chart__slice', { empty: isEmpty })}
            d={arc(datum) ?? undefined}
            fill={isEmpty ? undefined : datum.data.colour}
          />
        ))}
      </g>
    </svg>
  );
}
