// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import LineChart, { makeOptionsDate } from 'charts/line-chart';
import { curveLinear } from 'd3';
import { escape } from 'lodash';
import * as moment from 'moment';
import core from 'osu-core-singleton';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

// conveniently both charts share same interface
export interface ChartData {
  x: Date;
  y: number;
}

interface Props {
  data: ChartData[];
  labelY: string;
}

function updateTicks(chart: LineChart<Date>, data: ChartData[]) {
  if (core.windowSize.isDesktop) {
    chart.options.ticksX = undefined;

    chart.options.tickValuesX = data.length < 10 ? data.map((d) => d.x) : undefined;
  } else {
    chart.options.ticksX = Math.min(6, data.length);
    chart.options.tickValuesX = undefined;
  }
}

// @observer
export default class Chart extends React.Component<Props> {
  private chart?: LineChart<Date>;
  private readonly disposers = new Set<(() => void) | undefined>();
  private readonly ref = React.createRef<HTMLDivElement>();

  constructor(props: Props) {
    super(props);

    // makeObservable(this);
  }

  componentDidMount() {
    $(window).on('resize', this.resizeChart);
    this.disposers.add(() => $(window).off('resize', this.resizeChart));
    this.updateChart();
  }

  componentWillUnmount() {
    this.disposers.forEach((disposer) => disposer?.());
  }

  render() {
    return <div ref={this.ref} />;
  }


  private readonly resizeChart = () => {
    this.chart?.resize();
  };

  private readonly updateChart = () => {
    if (this.ref.current == null) return; // for typing purposes, ref object shouldn't be null in componentDidMount();

    if (this.chart == null) {
      const options = makeOptionsDate({
        circleLine: true,
        curve: curveLinear,
        formatX: (d: Date) => moment.utc(d).format(trans('common.datetime.year_month_short.moment')),
        formatY: (d: number) => formatNumber(d),
        infoBoxFormatX: (d: Date) => moment.utc(d).format(trans('common.datetime.year_month.moment')),
        infoBoxFormatY: (d: number) => `<strong>${this.props.labelY}</strong> ${escape(formatNumber(d))}`,
        marginRight: 60, // more spacing for x axis label
        modifiers: 'profile-page',
      });

      this.chart = new LineChart(this.ref.current, options);
    }

    const definedChart = this.chart;

    this.disposers.add(core.reactTurbolinks.runAfterPageLoad(() => {
      updateTicks(definedChart, this.props.data);
      definedChart.loadData(this.props.data);
    }));
  };
}
