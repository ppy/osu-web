// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import LineChart, { makeOptionsNumber } from 'charts/line-chart';
import { Spinner } from 'components/spinner';
import { scaleLinear, scaleLog } from 'd3';
import { autorun, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as moment from 'moment';
import core from 'osu-core-singleton';
import Controller from 'profile-page/controller';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

interface Props {
  controller: Controller;
  poolId: number;
}

const options = makeOptionsNumber({
  axisLabels: false,
  circleLine: true,
  infoBoxFormatX: formatX,
  infoBoxFormatY: formatY,
  marginBottom: 15,
  marginLeft: 0,
  marginRight: 0,
  marginTop: 15,
  modifiers: 'profile-page profile-page-card',
  scaleX: scaleLinear(),
  scaleY: scaleLog(),
});

function formatX(d: number) {
  return moment.utc(d).format('y/M/D');
}

function formatY(d: number) {
  return `<strong>${trans('users.show.matchmaking.rating')}</strong> ${formatNumber(d)}`;
}

@observer
export default class RankedPlayChart extends React.Component<Props> {
  private readonly disposers = new Set<(() => void) | undefined>();
  private rankChart?: LineChart<number>;
  private readonly rankChartArea = React.createRef<HTMLDivElement>();

  @computed
  get data() {
    const raw = this.props.controller.state.lazyMatchmakingChart[this.props.poolId] ?? [];

    if (raw.length === 0) {
      return [];
    }

    // date: rating
    const byDate = new Map<number, number>();
    // assume raw is sorted descending by date
    for (const entry of raw) {
      const date = +moment(entry.created_at).utc().startOf('day');
      if (!byDate.has(date)) {
        byDate.set(date, entry.elo_after);
      }
    }
    const data = [...byDate.entries()].map(([date, rating]) => ({ x: date, y: rating })).reverse();

    if (data.length === 1) {
      data.unshift({ x: +moment(data[0].x).subtract(1, 'day'), y: data[0].y });
    }

    return data;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  componentDidMount() {
    if (this.rankChartArea.current == null) return;

    if (this.rankChart == null) {
      const rankChart = new LineChart(this.rankChartArea.current, options);
      $(window).on('resize', rankChart.resize);
      this.disposers.add(() => $(window).off('resize', rankChart.resize));
      this.rankChart = rankChart;
    }

    this.disposers.add(core.reactTurbolinks.runAfterPageLoad(this.loadRankChart));
  }

  componentWillUnmount() {
    this.disposers.forEach((disposer) => disposer?.());
  }

  render() {
    const loading = this.props.controller.state.lazyMatchmakingChart[this.props.poolId] == null;

    return (
      <div className={classWithModifiers('matchmaking-chart', { loading })}>
        <div className='matchmaking-chart__spinner'>
          <Spinner />
        </div>
        <div className='matchmaking-chart__chart'>
          <div ref={this.rankChartArea} />
        </div>
      </div>
    );
  }

  private readonly loadRankChart = () => {
    this.disposers.add(autorun(() => {
      this.props.controller.loadMatchmakingChart(this.props.poolId);
      this.rankChart?.loadData(this.data);
    }));
  };
}
