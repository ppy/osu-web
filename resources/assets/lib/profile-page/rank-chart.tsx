// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as d3 from 'd3';
import RankHistoryJson from 'interfaces/rank-history-json';
import UserStatisticsJson from 'interfaces/user-statistics-json';
import { last } from 'lodash';
import core from 'osu-core-singleton';
import * as React from 'react';
import { nextVal } from 'utils/seq';

interface Props {
  rankHistory: RankHistoryJson | null;
  stats: UserStatisticsJson;
}

const options = {
  axisLabels: false,
  circleLine: true,
  infoBoxFormats: {
    x: formatX,
    y: formatY,
  },
  margins: {
    bottom: 15,
    left: 15, // referenced in css .profile-detail__col--bottom-left
    right: 15,
    top: 15,
  },
  modifiers: 'profile-page',
  scales: {
    x: d3.scaleLinear(),
    y: d3.scaleLog(),
  },
};

function formatX(d: number) {
  return d === 0 ? osu.trans('common.time.now') : osu.transChoice('common.time.days_ago', -d);
}

function formatY(d: number) {
  return `<strong>${osu.trans('users.show.rank.global_simple')}</strong> #${osu.formatNumber(-d)}`;
}

export default class RankChart extends React.Component<Props> {
  private readonly id = `rank-chart-${nextVal()}`;
  private rankChart?: LineChart;
  private readonly rankChartArea = React.createRef<HTMLDivElement>();

  get data() {
    if (!this.props.stats.is_ranked) return [];

    const raw = this.props.rankHistory?.data ?? [];
    const data = raw.map((rank, i) => ({ x: i - raw.length + 1, y: -rank })).filter((point) => point.y < 0);
    if (data.length > 0) {
      if (data.length === 1) {
        data.unshift({ x: data[0].x - 1, y: data[0].y });
      }

      const lastData = last(data);

      if (lastData?.x === 0) {
        lastData.y = -this.props.stats.global_rank;
      } else {
        data.push({ x: 0, y: -this.props.stats.global_rank });
      }
    }

    return data;
  }

  componentDidMount() {
    if (this.rankChartArea.current == null) return;

    if (this.rankChart == null) {
      this.rankChart = new LineChart(this.rankChartArea.current, options);

      $(window).on(`resize.${this.id}`, this.rankChart.resize);
    }

    core.reactTurbolinks.runAfterPageLoad(this.id, this.loadRankChart);
  }

  componentWillUnmount() {
    $(window).off(`.${this.id}`);
  }

  render() {
    return <div ref={this.rankChartArea} />;
  }

  private loadRankChart = () => {
    if (this.rankChart == null) return;

    this.rankChart.loadData(this.data);
  };
}
