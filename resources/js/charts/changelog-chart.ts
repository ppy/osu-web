// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as d3 from 'd3';
import { first, groupBy, kebabCase, keyBy, last, map } from 'lodash';
import moment from 'moment';
import { fadeIn, fadeOut } from 'utils/fade';
import { formatNumber } from 'utils/html';
import { parseJson } from 'utils/json';

interface BuildHistory {
  created_at: string;
  label: string;
  user_count: number;
}

interface ChartData {
  build_history: BuildHistory[];
  order: string[];
  stream_name: string | null;
}

interface DataObj {
  builds: Record<string, BuildHistory>;
  created_at: string;
  date: Date;
  date_formatted: string;
}

type Datum = d3.SeriesPoint<DataObj>;

export default class ChangelogChart {
  private readonly area;
  private readonly areaFunction;
  private autoHideTooltip?: number;
  private chartData?: ChartData;
  private data: d3.Series<DataObj, string>[] = [];
  private height = 0;
  private readonly hoverArea;
  private readonly scales;
  private readonly svg;
  private readonly svgWrapper;
  private readonly tooltip;
  private readonly tooltipArea;
  private readonly tooltipContainer;
  private readonly tooltipDate;
  private readonly tooltipLine;
  private readonly tooltipName;
  private readonly tooltipUserCount;
  private width = 0;
  private x?: Date;
  private y?: number;

  private get hasData() {
    return this.data.length > 0;
  }

  constructor(area: HTMLElement) {
    this.scales = {
      class: d3.scaleOrdinal<string>(),
      x: d3.scaleTime(),
      y: d3.scaleLinear(),
    };

    this.area = d3.select(area);
    this.area.classed('changelog-chart', true);

    this.svg = this.area.append('svg');
    this.svgWrapper = this.svg.append('g');

    this.areaFunction = d3
      .area<Datum>()
      .curve(d3.curveMonotoneX)
      .x((d) => this.scales.x(d.data.date))
      .y1((d) => this.scales.y(d[1]))
      .y0((d) => this.scales.y(d[0]));

    this.hoverArea = this.svg
      .append('rect')
      .classed('changelog-chart__hover-area', true)
      .on('mouseout', this.tooltipHide)
      .on('mousemove', this.tooltipMove);

    this.tooltipArea = this.area
      .append('div')
      .classed('changelog-chart__tooltip-area', true);

    this.tooltipContainer = this.tooltipArea
      .append('div')
      .classed('changelog-chart__tooltip-container', true)
      .attr('data-visibility', 'hidden');

    this.tooltipContainer
      .append('div')
      .classed('changelog-chart__tooltip-line', true);

    this.tooltip = this.tooltipContainer
      .append('div')
      .classed('changelog-chart__tooltip', true);

    this.tooltipName = this.tooltip.append('div');

    this.tooltipUserCount = this.tooltip
      .append('div')
      .classed('changelog-chart__text changelog-chart__text--user-count', true);

    this.tooltipDate = this.tooltip
      .append('div')
      .classed('changelog-chart__text changelog-chart__text--date', true);

    this.tooltipContainer
      .append('div')
      .classed('changelog-chart__tooltip-line', true);

    this.tooltipLine = this.tooltipContainer.selectAll(
      '.changelog-chart__tooltip-line',
    );
  }

  loadData() {
    this.chartData = parseJson('json-chart-config');

    const data = this.normalizeData(this.chartData.build_history);

    const stack = d3
      .stack<DataObj, string>()
      .keys(this.chartData.order)
      .offset(d3.stackOffsetExpand)
      .value((d, val) => (d.builds[val]?.user_count ?? 0));

    this.data = stack(data);

    this.resize();
  }

  resize() {
    this.area.classed('hidden', !this.hasData);

    if (!this.hasData) return;

    this.setDimensions();
    this.setScalesRange();
    this.setSvgSize();
    this.setHoverAreaSize();
    this.drawLines();
    this.tooltipPosition();
  }

  private drawLines() {
    this.svgWrapper
      .selectAll('g')
      .data(this.data)
      .enter()
      .append('path')
      .attr('class', (d) => `changelog-chart__area changelog-chart__area--${this.scales.class(d.key)}`)
      .attr('d', this.areaFunction);
  }

  private normalizeData(rawData: BuildHistory[]) {
    // normalize the user count values
    // and parse data into a form digestible by d3.stack()
    const sortedData = groupBy(rawData, 'created_at');

    return map(sortedData, (values, timestamp): DataObj => {
      // parse date stored in strings to JS Date object for use by
      // d3 domains, and format it into a string shown on the tooltip
      const m = moment(timestamp);

      return {
        builds: keyBy(values, 'label'),
        created_at: timestamp,
        date: m.toDate(),
        date_formatted: m.format('YYYY/MM/DD'),
      };
    });
  }

  private setDimensions() {
    const areaDims = this.area.node()?.getBoundingClientRect();
    if (!areaDims) return;

    this.width = areaDims.width;
    this.height = areaDims.height;
  }

  private setHoverAreaSize() {
    this.hoverArea.attr('width', this.width).attr('height', this.height);
  }

  private setScalesRange() {
    if (this.chartData == null) return;

    this.scales.x.range([0, this.width]).domain([
      first(this.data[0])?.data.date ?? 0,
      last(this.data[0])?.data.date ?? 0,
    ]);

    this.scales.y.range([0, this.height]).domain([0, 1]);

    this.scales.class.range(
      this.chartData.order.map((d, i) =>
        // rotate over available build ids (0-6) when the amount of builds
        // exceeds the available amount of colors
        this.chartData?.stream_name != null
          ? `${this.chartData.stream_name}-build-${i % 7}`
          : kebabCase(d),
      ),
    ).domain(this.chartData.order);
  }

  private setSvgSize() {
    this.svg.attr('width', this.width).attr('height', this.height);
  }

  private readonly tooltipHide = () => fadeOut(this.tooltipContainer.node());

  private readonly tooltipMove = (event: Event) => {
    const mousePos = d3.pointer(event);
    this.x = this.scales.x.invert(mousePos[0]);
    this.y = mousePos[1] / this.height;

    this.tooltipShow();

    clearTimeout(this.autoHideTooltip);
    this.autoHideTooltip = setTimeout(this.tooltipHide, 3000);

    this.tooltipPosition();
  };

  private tooltipPosition() {
    const { x, y } = this;

    if (x == null || y == null) return;

    const pos = d3
      .bisector<Datum, Date>((d) => d.data.date)
      .left(this.data[0], x);

    let tooltipData: DataObj | null = null;
    let currentLabel = '';
    let labelModifier = '';

    for (const el of this.data) {
      if (y <= el[pos][1] && el[pos].data.builds[el.key] != null) {
        tooltipData = el[pos].data;
        currentLabel = el.key;
        labelModifier = this.scales.class(currentLabel);
        break;
      }
    }

    const coord = this.scales.x(x);

    this.tooltipName
      .attr(
        'class',
        `changelog-chart__text changelog-chart__text--name changelog-chart__text--${labelModifier}`,
      )
      .text(currentLabel);
    this.tooltipUserCount.text(formatNumber(tooltipData?.builds[currentLabel].user_count ?? 0));
    this.tooltipDate.text(tooltipData?.date_formatted ?? '');

    const tooltipWidth = this.tooltip.node()?.getBoundingClientRect().width ?? 0;
    const tooltipXBase = coord - tooltipWidth / 2;

    // shift the tooltip container when near to the left/right edge
    // of the chart, so that the tooltip doesn't extend outside of it
    const tooltipX = tooltipXBase < 0
      ? 0
      : tooltipXBase + tooltipWidth > this.width
        ? this.width - tooltipWidth
        : tooltipXBase;

    this.tooltip.style('transform', `translateX(${tooltipX}px)`);
    this.tooltipLine.style('transform', `translateX(${coord}px)`);
  }

  private readonly tooltipShow = () => fadeIn(this.tooltipContainer.node());
}
