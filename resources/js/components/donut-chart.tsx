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
  value: number;
}

interface Props {
  hoveredKey: string | null;
  onHover: (key: string | null) => void;
  slices: DonutChartSlice[];
}

export default function DonutChart({ hoveredKey, onHover, slices }: Props) {
  const onMouseEnter = React.useCallback((event: React.MouseEvent<SVGPathElement>) => {
    onHover(event.currentTarget.dataset.sliceKey ?? null);
  }, [onHover]);

  const onMouseLeave = React.useCallback(() => {
    onHover(null);
  }, [onHover]);

  const pie = d3.pie<DonutChartSlice>()
    .sortValues(null)
    .padAngle(slices.length > 1 ? 0.02 : 0)
    .value((slice) => slice.value);

  const arc = d3.arc<d3.PieArcDatum<DonutChartSlice>>()
    .innerRadius(50)
    .outerRadius(outerRadius)
    .cornerRadius(5);

  return (
    <div className='donut-chart'>
      <svg aria-hidden='true' className='donut-chart__svg' viewBox={`0 0 ${viewBoxSize} ${viewBoxSize}`}>
        <g transform={`translate(${outerRadius}, ${outerRadius})`}>
          {pie(slices).map((datum) => (
            <path
              key={datum.data.key}
              className={classWithModifiers('donut-chart__slice', {
                dimmed: hoveredKey != null && hoveredKey !== datum.data.key,
              })}
              d={arc(datum) ?? undefined}
              data-slice-key={datum.data.key}
              fill={datum.data.colour}
              onMouseEnter={onMouseEnter}
              onMouseLeave={onMouseLeave}
            />
          ))}
        </g>
      </svg>
    </div>
  );
}
