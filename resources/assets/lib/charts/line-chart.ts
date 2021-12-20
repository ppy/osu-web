// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  Axis,
  axisBottom,
  axisLeft,
  bisector,
  CurveFactory,
  curveMonotoneX,
  extent,
  Line,
  line,
  pointer,
  ScaleContinuousNumeric,
  scaleLinear,
  ScaleTime,
  scaleTime,
  select,
  Selection,
} from 'd3';
import { clamp } from 'lodash';
import core from 'osu-core-singleton';
import { classWithModifiers, Modifiers } from 'utils/css';
import { fadeIn, fadeOut } from 'utils/fade';

const bn = 'line-chart';

type ScaleOf<T extends Date | number> = T extends Date ? ScaleTime<number, number> : ScaleContinuousNumeric<number, number>;

interface Options<X extends Date | number> {
  axisLabels: boolean;
  circleLine: boolean;
  curve: CurveFactory;
  formatX: (d: X) => string;
  formatY: (d: number) => string;
  infoBoxFormatX: (d: X) => string;
  infoBoxFormatY: (d: number) => string;
  marginBottom: number;
  marginLeft: number;
  marginRight: number;
  marginTop: number;
  modifiers?: Modifiers;
  scaleX: ScaleOf<X>;
  scaleY: ScaleContinuousNumeric<number, number>;
  ticksX?: number;
  tickValuesX?: X[] | null;
}

function defaultFormatter(d: Date | number) {
  return d.toString();
}

export function makeOptionsDate(options: Partial<Options<Date>>): Options<Date> {
  return {
    ...makeSharedDefaultOptions(options),
    scaleX: options.scaleX ?? scaleTime(),
  };
}
export function makeOptionsNumber(options: Partial<Options<number>>): Options<number> {
  return {
    ...makeSharedDefaultOptions(options),
    scaleX: options.scaleX ?? scaleLinear(),
  };
}

function makeSharedDefaultOptions<X extends Date | number>(options: Partial<Options<X>>): Omit<Options<X>, 'scaleX'> {
  return {
    axisLabels: options.axisLabels ?? true,
    circleLine: options.circleLine ?? false,
    curve: options.curve ?? curveMonotoneX,
    formatX: options.formatX ?? defaultFormatter,
    formatY: options.formatY ?? defaultFormatter,
    infoBoxFormatX: options.infoBoxFormatX ?? options.formatX ?? defaultFormatter,
    infoBoxFormatY: options.infoBoxFormatY ?? options.formatY ?? defaultFormatter,
    marginBottom: options.marginBottom ?? 50,
    marginLeft: options.marginLeft ?? 60,
    marginRight: options.marginRight ?? 20,
    marginTop: options.marginTop ?? 20,
    modifiers: options.modifiers,
    scaleY: options.scaleY ?? scaleLinear(),
    ticksX: options.ticksX,
    tickValuesX: options.tickValuesX,
  };
}

const hoverAreaMarginBleed = 10;

export default class LineChart<X extends Date | number> {
  data: { x: X; y: number }[] = [];

  private readonly area: Selection<HTMLElement, unknown, null, undefined>;
  private autoEndHoverTimeout?: number;
  private readonly axes?: {
    svgX: Selection<SVGGElement, unknown, null, undefined>;
    svgY: Selection<SVGGElement, unknown, null, undefined>;
    x: Axis<number | { valueOf(): number }>;
    y: Axis<number | { valueOf(): number }>;
  };
  private height = 0;
  private readonly hover: Selection<HTMLDivElement, unknown, null, undefined>;
  private readonly hoverArea: Selection<HTMLDivElement, unknown, null, undefined>;
  private readonly hoverCircle: Selection<HTMLDivElement, unknown, null, undefined>;
  private readonly hoverInfoBox: Selection<HTMLDivElement, unknown, null, undefined>;
  private readonly hoverInfoBoxX: Selection<HTMLDivElement, unknown, null, undefined>;
  private readonly hoverInfoBoxY: Selection<HTMLDivElement, unknown, null, undefined>;
  private readonly hoverLine?: Selection<HTMLDivElement, unknown, null, undefined>;
  private readonly line: Line<typeof this.data[number]>;
  private readonly svg: Selection<SVGSVGElement, unknown, null, undefined>;
  private readonly svgLine: Selection<SVGPathElement, unknown, null, undefined>;
  private readonly svgWrapper: Selection<SVGGElement, unknown, null, undefined>;
  private width = 0;

  constructor(area: HTMLElement, public options: Options<X>) {
    this.area = select(area)
      .classed(classWithModifiers(bn, this.options.modifiers), true);

    this.svg = this.area.append('svg');

    this.svgWrapper = this.svg.append('g')
      .classed(`${bn}__wrapper`, true);

    if (this.options.axisLabels) {
      this.axes = {
        svgX: this.svgWrapper.append('g')
          .classed(`${bn}__axis ${bn}__axis--x`, true),

        svgY: this.svgWrapper.append('g')
          .classed(`${bn}__axis ${bn}__axis--y`, true),

        x: axisBottom(this.options.scaleX)
          .tickSizeOuter(0)
          .tickPadding(5),

        y: axisLeft(this.options.scaleY).ticks(4),
      };
    }


    this.svgLine = this.svgWrapper.append('path')
      .classed(`${bn}__line`, true);

    this.hoverArea = this.area.append('div')
      .classed(`${bn}__hover-area`, true)
      .style('top', `${this.options.marginTop}px`)
      .style('bottom', `${this.options.marginBottom}px`)
      .style('left', `${this.options.marginLeft - hoverAreaMarginBleed}px`)
      .style('right', `${this.options.marginRight - hoverAreaMarginBleed}px`)
      .style('padding', `0 ${hoverAreaMarginBleed}px`)
      .on('mouseout', this.hoverEnd)
      .on('mousemove', this.onHover)
      .on('drag', this.onHover);

    this.hover = this.hoverArea.append('div')
      .classed(`${bn}__hover`, true)
      .attr('data-visibility', 'hidden');

    if (this.options.circleLine) {
      this.hoverLine = this.hover.append('div')
        .classed(`${bn}__hover-line`, true);
    }

    this.hoverCircle = this.hover.append('div')
      .classed(`${bn}__hover-circle`, true);

    this.hoverInfoBox = this.hover.append('div')
      .classed(`${bn}__hover-info-box`, true)
      .attr('data-float', 'left');

    this.hoverInfoBoxX = this.hoverInfoBox.append('div')
      .classed(`${bn}__hover-info-box-text ${bn}__hover-info-box-text--x`, true);

    this.hoverInfoBoxY = this.hoverInfoBox.append('div')
      .classed(`${bn}__hover-info-box-text ${bn}__hover-info-box-text--y`, true);

    this.line = line<typeof this.data[number]>().curve(this.options.curve);
  }

  loadData(data: typeof this.data) {
    this.data = data;
    this.svgLine.datum(data);

    this.resize();
  }

  readonly resize = () => {
    const hasDimensions = this.setDimensions();

    if (!hasDimensions) return;

    this.setScalesRange();

    this.setSvgSize();
    this.setWrapperSize();
    this.setAxesSize();
    this.setLineSize();

    this.drawAxes();
    this.drawLine();

    this.hoverReset();
  };

  private drawAxes() {
    if (this.axes == null) return;

    this.axes.svgX
      .transition()
      .attr('transform', `translate(0, ${this.height})`)
      .call(this.axes.x);

    this.axes.svgY
      .transition()
      .call(this.axes.y);

    this.axes.svgX.selectAll('.tick line')
      .classed(`${bn}__tick-line ${bn}__tick-line--default`, true);

    this.axes.svgY.selectAll('.tick line')
      .classed(`${bn}__tick-line ${bn}__tick-line--default`, true);

    this.axes.svgX.selectAll('.domain')
      .classed('u-hidden', true);

    this.axes.svgY.selectAll('.domain')
      .classed('u-hidden', true);

    this.axes.svgX.selectAll('text')
      .style('text-anchor', 'start')
      .attr('transform', 'rotate(45) translate(5, 0)')
      .classed(`${bn}__tick-text ${bn}__tick-text--strong`, true);

    this.axes.svgY.selectAll('text')
      .classed(`${bn}__tick-text`, true);
  }

  private drawLine() {
    this.svgLine
      .transition()
      .attr('d', this.line);
  }

  private readonly hoverEnd = () => {
    fadeOut(this.hover.node());
  };

  private hoverReset() {
    // Immediately hide so its position can be invisibly reset.
    this.hoverStyle('transition', 'none');
    this.hoverEnd();
    this.hoverStyle('transform', '');
    // Out of current loop so browser doesn't optimize out the styling
    // and ignores previously set transition override.
    window.setTimeout(() => {
      this.hoverStyle('transition', '');
    });
  }

  private readonly hoverStart = () => {
    fadeIn(this.hover.node());
  };

  private hoverStyle(key: string, value: string | number | boolean) {
    for (const elem of  [this.hoverLine, this.hoverCircle]) {
      elem?.style(key, value);
    }
  }

  private lookupIndexFromX(x: X) {
    return bisector((d: typeof this.data[number]) => d.x).left(this.data, x);
  }

  private readonly onHover = (event: DragEvent | MouseEvent) => {
    const relativeX = pointer(event)[0] - hoverAreaMarginBleed;
    // invert of scaleX should give X. Without the cast it'll be union of possible types of X instead.
    const x = this.options.scaleX.invert(relativeX) as X;
    const i = clamp(this.lookupIndexFromX(x), 1, this.data.length - 1);

    this.hoverStart();
    window.clearTimeout(this.autoEndHoverTimeout);
    if (core.windowSize.isMobile) {
      this.autoEndHoverTimeout = window.setTimeout(this.hoverEnd, 3000);
    }

    const d = x.valueOf() - this.data[i - 1].x.valueOf() <= this.data[i].x.valueOf() - x.valueOf() ? this.data[i - 1] : this.data[i];

    // rounded to avoid blurry positioning
    const coords = [
      `${Math.round(this.options.scaleX(d.x))}px`,
      `${Math.round(this.options.scaleY(d.y))}px`,
    ];

    this.hoverLine?.style('transform', `translateX(${coords[0]})`);
    this.hoverCircle.style('transform', `translate(${coords.join(',')})`);

    this.hoverInfoBoxX.html(this.options.infoBoxFormatX(d.x));
    this.hoverInfoBoxY.html(this.options.infoBoxFormatY(d.y));

    const mouseX = event.clientX;

    const infoBoxRect = this.hoverInfoBox.node()?.getBoundingClientRect();
    if (infoBoxRect != null) {
      if (this.hoverInfoBox.attr('data-float') === 'right') {
        if (mouseX > infoBoxRect.left) {
          this.hoverInfoBox.attr('data-float', 'left');
        }
      } else {
        if (mouseX < infoBoxRect.right) {
          this.hoverInfoBox.attr('data-float', 'right');
        }
      }
    }
  };

  private setAxesSize() {
    if (this.axes == null) return;

    this.axes.x
      .scale(this.options.scaleX)
      .tickSizeInner(-this.height)
      .ticks(this.options.ticksX ?? 15)
      .tickFormat(this.options.formatX);

    // this looks dumb but the typing doesn't allow `tickValuesX ?? null` argument...
    if (this.options.tickValuesX == null) {
      this.axes.x.tickValues(null);
    } else {
      this.axes.x.tickValues(this.options.tickValuesX);
    }

    this.axes.y
      .scale(this.options.scaleY)
      .tickSizeInner(-this.width)
      .tickFormat(this.options.formatY);
  }

  private setDimensions() {
    const areaDims = this.area.node()?.getBoundingClientRect();

    if (areaDims == null || areaDims.width === 0 || areaDims.height === 0) {
      return false;
    }

    this.width = areaDims.width - (this.options.marginLeft + this.options.marginRight);
    this.height = areaDims.height - (this.options.marginTop + this.options.marginBottom);

    return true;
  }

  private setLineSize() {
    this.line
      .x((d) => this.options.scaleX(d.x))
      .y((d) => this.options.scaleY(d.y));
  }

  private setScalesRange() {
    this.options.scaleX.range([0, this.width]);
    const [minX, maxX] = extent(this.data.map((d) => d.x));
    if (minX != null && maxX != null) {
      this.options.scaleX.domain([minX, maxX]);
    }

    this.options.scaleY.range([this.height, 0]);
    const [minY, maxY] = extent(this.data.map((d) => d.y));
    if (minY != null && maxY != null) {
      this.options.scaleY.domain([minY, maxY]);
    }
  }

  private setSvgSize() {
    this.svg
      .attr('width', this.width + (this.options.marginLeft + this.options.marginRight))
      .attr('height', this.height + (this.options.marginTop + this.options.marginBottom));
  }

  private setWrapperSize() {
    this.svgWrapper
      .attr('transform', `translate(${this.options.marginLeft}, ${this.options.marginTop})`);
  }
}
