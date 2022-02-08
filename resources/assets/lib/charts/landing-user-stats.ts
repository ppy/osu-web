// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as d3 from 'd3';
import { maxBy } from 'lodash';
import { parseJson } from 'utils/json';

interface Datum {
  x: number;
  y: number;
}

const margin = {
  bottom: 0,
  left: 0,
  right: 0,
  top: 40,
} as const;

// radius for peak circle
const peakR = 5;

export default class LandingUserStats {
  private readonly area: d3.Area<Datum>;
  private data: Datum[] = [];
  private height = 0;
  private maxElem: Datum = { x: 0, y: 0 };
  private peakTextLength = 0;
  private readonly scaleX = d3.scaleLinear();
  private readonly scaleY = d3.scaleTime();
  private readonly svg: d3.Selection<SVGGElement, unknown, HTMLElement, unknown>;
  private readonly svgArea: d3.Selection<SVGPathElement, unknown, HTMLElement, unknown>;
  private readonly svgContainerInner: d3.Selection<SVGSVGElement, unknown, HTMLElement, unknown>;
  private readonly svgContainerOuter: d3.Selection<d3.BaseType, unknown, HTMLElement, unknown>;
  private readonly svgPeakCircle: d3.Selection<SVGCircleElement, unknown, HTMLElement, unknown>;
  private readonly svgPeakText: d3.Selection<SVGTextElement, unknown, HTMLElement, unknown>;
  private width = 0;

  constructor() {
    // Define basic elements
    this.svgContainerOuter = d3.select('.js-landing-graph');

    // Clear out previously set graphs
    this.svgContainerOuter.selectAll('svg').remove();

    this.svgContainerInner = this.svgContainerOuter
      .append('svg')
      .attr('class', 'landing-graph');

    this.svg = this.svgContainerInner
      .append('g')
      // Ensure no blank space at the bottom at certain zoom level in Firefox.
      .attr('transform', `translate(${margin.left}, ${margin.top + 1})`);

    this.svgArea = this.svg
      .append('path')
      .attr('class', 'landing-graph__area');

    this.svgPeakText = this.svg
      .append('text')
      .attr('class', 'landing-graph__text')
      .attr('y', (-peakR * 2));

    this.svgPeakCircle = this.svg
      .append('circle')
      .attr('class', 'landing-graph__circle')
      .attr('cy', 0)
      .attr('r', peakR);

    this.area = d3.area<Datum>()
      .curve(d3.curveBasis)
      .x((d) => this.scaleX(d.x))
      .y0(() => this.height)
      .y1((d) => this.scaleY(d.y));

    this.loadData();
    this.resize();
  }

  readonly resize = () => {
    if (this.data.length === 0) return;

    // set basic dimensions
    this.width = parseInt(this.svgContainerOuter.style('width'), 10) - margin.left - margin.right;
    this.height = parseInt(this.svgContainerOuter.style('height'), 10) - margin.top - margin.bottom;

    // set range of scales
    this.scaleX.range([0, this.width]);
    this.scaleY.range([this.height, 0]);

    // resize svgContainerInner
    this.svgContainerInner
      .attr('width', this.width + margin.left + margin.right)
      .attr('height', this.height + margin.top + margin.bottom);

    // resize svgArea
    this.svgArea
      .datum(this.data)
      .attr('d', this.area);

    // reposition peak circle...
    this.svgPeakCircle.attr('cx', this.scaleX(this.maxElem.x));

    // ...and its label
    this.svgPeakText.attr('x', () => {
      const rightX = this.scaleX(this.maxElem.x) + (peakR * 2);
      return (this.peakTextLength + rightX) > this.width
        ? this.scaleX(this.maxElem.x) - (this.peakTextLength + (peakR * 2))
        : rightX;
    });
  };

  private loadData() {
    this.data = parseJson<Datum[]>('json-stats');

    if (this.data.length === 0) return;

    // the null coalesce should be a noop due to length check above
    this.maxElem = maxBy(this.data, (d) => d.y) ?? this.data[0];

    const scaleXDomain = d3.extent(this.data, (d) => d.x);
    // again, null coalesce should be a noop due to length check and data being proper
    this.scaleX.domain([scaleXDomain[0] ?? 0, scaleXDomain[1] ?? 0]);
    this.scaleY.domain([0, this.maxElem.y]);

    this.svgPeakText.text(osu.trans('home.landing.peak', { count: osu.formatNumber(this.maxElem.y) }));
    const textNode = this.svgPeakText.node();

    if (textNode == null) {
      // this shouldn't be possible...
      throw new Error('peak text node is missing');
    }
    this.peakTextLength = textNode.getComputedTextLength();
  }
}
