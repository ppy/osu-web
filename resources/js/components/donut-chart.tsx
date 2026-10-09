// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as d3 from 'd3';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

const viewBoxSize = 200;
const outerRadius = viewBoxSize / 2;

interface DonutChartSlice {
  colour: string;
  key: string;
  title?: string;
  value: number;
}

interface Props {
  emptyTitle?: string;
  slices: DonutChartSlice[];
}

function onSliceEvent(event: React.SyntheticEvent<SVGPathElement>) {
  const key = event.currentTarget.dataset.sliceKey;
  if (key == null) return;

  const anchor = event.currentTarget.closest('.donut-chart')?.querySelector<HTMLElement>(
    `.donut-chart__anchor[data-slice-key="${key}"]`,
  );
  if (anchor == null) return;

  $(anchor).trigger(event.type);
}

export default function DonutChart({ emptyTitle, slices }: Props) {
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
    .outerRadius(outerRadius)
    .cornerRadius(5);

  const arcs = pie(pieSlices);

  return (
    <div className='donut-chart'>
      <svg aria-hidden='true' className='donut-chart__svg' viewBox={`0 0 ${viewBoxSize} ${viewBoxSize}`}>
        <g transform={`translate(${outerRadius}, ${outerRadius})`}>
          {arcs.map((datum) => (
            <path
              key={datum.data.key}
              className={classWithModifiers('donut-chart__slice', { empty: isEmpty })}
              d={arc(datum) ?? undefined}
              data-slice-key={datum.data.key}
              fill={isEmpty ? undefined : datum.data.colour}
              onMouseLeave={onSliceEvent}
              onMouseOver={onSliceEvent}
              onTouchStart={onSliceEvent}
            />
          ))}
        </g>
      </svg>
      {arcs.map((datum) => {
        const [x, y] = arcs.length === 1 ? [0, -outerRadius] : arc.centroid(datum);

        return (
          <span
            key={datum.data.key}
            className='donut-chart__anchor'
            data-slice-key={datum.data.key}
            style={{
              left: `${((outerRadius + x) / viewBoxSize) * 100}%`,
              top: `${((outerRadius + y) / viewBoxSize) * 100}%`,
            }}
            title={isEmpty ? emptyTitle : datum.data.title}
          />
        );
      })}
    </div>
  );
}
