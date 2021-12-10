// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import LineChart, { makeOptionsDate } from 'charts/line-chart';
import { curveLinear } from 'd3';
import BeatmapPlaycountJson from 'interfaces/beatmap-playcount-json';
import GameMode from 'interfaces/game-mode';
import ScoreJson from 'interfaces/score-json';
import { route } from 'laroute';
import { escape, sortBy, times } from 'lodash';
import * as moment from 'moment';
import core from 'osu-core-singleton';
import PlayDetailList from 'play-detail-list';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import { nextVal } from 'utils/seq';
import BeatmapPlaycount from './beatmap-playcount';
import ExtraHeader from './extra-header';
import ExtraPageProps, { ProfilePagePaginationData } from './extra-page-props';

const chartSections =['monthly_playcounts', 'replays_watched_counts'] as const;
type ChartSection = typeof chartSections[number];

// conveniently both charts share same interface
interface ChartData {
  x: Date;
  y: number;
}

function dataPadder(padded: ChartData[], entry: ChartData) {
  if (padded.length > 0) {
    const lastEntry = padded[padded.length - 1];
    const missingMonths = moment(entry.x).diff(moment(lastEntry.x), 'months') - 1;

    times(missingMonths, (i) => {
      padded.push({
        x: moment(lastEntry.x).add(i + 1, 'months').toDate(),
        y: 0,
      });
    });
  }

  padded.push(entry);

  return padded;
}

function updateTicks(chart: LineChart<Date>, data?: ChartData[]) {
  data ??= chart.data;

  if (core.windowSize.isDesktop) {
    chart.options.ticksX = undefined;

    chart.options.tickValuesX = data.length < 10 ?  data.map((d) => d.x) : undefined;
  } else {
    chart.options.ticksX = Math.min(6, data.length);
    chart.options.tickValuesX = undefined;
  }
}

interface Props extends ExtraPageProps {
  beatmapPlaycounts: BeatmapPlaycountJson[];
  currentMode: GameMode;
  pagination: ProfilePagePaginationData;
  scoresRecent: ScoreJson[];
}

export default class Historical extends React.PureComponent<Props> {
  private readonly chartRefs = {
    monthly_playcounts: React.createRef<HTMLDivElement>(),
    replays_watched_counts: React.createRef<HTMLDivElement>(),
  };
  private readonly charts: Partial<Record<ChartSection, LineChart<Date>>> = {};
  private readonly id = `users-show-historical-${nextVal()}`;

  componentDidMount() {
    $(window).on(`resize.${this.id}`, this.resizeCharts);
    this.updateCharts();
  }

  componentDidUpdate() {
    this.updateCharts();
  }

  componentWillUnmount() {
    $(window).off(`.${this.id}`);
    $(document).off(`.${this.id}`);
  }

  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.withEdit} />

        {this.hasSection('monthly_playcounts') &&
          <>
            <h3 className='title title--page-extra-small'>
              {osu.trans('users.show.extra.historical.monthly_playcounts.title')}
            </h3>

            <div className='page-extra__chart'>
              <div ref={this.chartRefs.monthly_playcounts} />
            </div>
          </>
        }

        <h3 className='title title--page-extra-small'>
          {osu.trans('users.show.extra.historical.most_played.title')}
          <span className='title__count'>
            {osu.formatNumber(this.props.user.beatmap_playcounts_count)}
          </span>
        </h3>

        {this.props.beatmapPlaycounts.length > 0 &&
          <>
            {this.props.beatmapPlaycounts.map((playcount) => (
              <BeatmapPlaycount
                key={playcount.beatmap_id}
                currentMode={this.props.currentMode}
                playcount={playcount}
              />
            ))}
            <ShowMoreLink
              data={{
                name: 'beatmapPlaycounts',
                url: route('users.beatmapsets', { type: 'most_played', user: this.props.user.id }),
              }}
              event='profile:showMore'
              hasMore={this.props.pagination.beatmapPlaycounts.hasMore}
              loading={this.props.pagination.beatmapPlaycounts.loading}
              modifiers='profile-page'
            />
          </>
        }

        <h3 className='title title--page-extra-small'>
          {osu.trans('users.show.extra.historical.recent_plays.title')}
          <span className='title__count'>
            {osu.formatNumber(this.props.user.scores_recent_count)}
          </span>
        </h3>

        {this.props.scoresRecent.length > 0 &&
          <>
            <PlayDetailList scores={this.props.scoresRecent} />

            <ShowMoreLink
              data={{
                name: 'scoresRecent',
                url: route('users.scores', { mode: this.props.currentMode, type: 'recent', user: this.props.user.id }),
              }}
              event='profile:showMore'
              hasMore={this.props.pagination.scoresRecent.hasMore}
              loading={this.props.pagination.scoresRecent.loading}
              modifiers='profile-page'
            />
          </>
        }

        {this.hasSection('replays_watched_counts') &&
          <>
            <h3 className='title title--page-extra-small'>
              {osu.trans('users.show.extra.historical.replays_watched_counts.title')}
            </h3>

            <div className='page-extra__chart'>
              <div ref={this.chartRefs.replays_watched_counts} />
            </div>
          </>
        }
      </div>
    );
  }

  private hasSection(attribute: ChartSection) {
    return this.props.user[attribute].length > 0;
  }

  private readonly resizeCharts = () => {
    Object.values(this.charts).forEach((chart) => {
      updateTicks(chart);
      chart.resize();
    });
  };

  private readonly updateChart = (attribute: ChartSection) => {
    const rawData = this.props.user[attribute];

    if (rawData.length === 0) return;

    const area = this.chartRefs[attribute].current;

    if (area == null) {
      throw new Error("chart can't be updated before the component is mounted");
    }

    const data = sortBy(rawData, 'start_date')
      .map((count) => ({
        x: new Date(count.start_date),
        y: count.count,
      })).reduce(dataPadder, []);

    if (data.length === 1) {
      data.unshift({
        x: moment(data[0].x).subtract(1, 'month').toDate(),
        y: 0,
      });
    }

    let chart = this.charts[attribute];
    if (chart == null) {
      const options = makeOptionsDate({
        circleLine: true,
        curve: curveLinear,
        formatX: (d: Date) => moment(d).format(osu.trans('common.datetime.year_month_short.moment')),
        formatY: (d: number) => osu.formatNumber(d),
        infoBoxFormatX: (d: Date) => moment(d).format(osu.trans('common.datetime.year_month.moment')),
        infoBoxFormatY: (d: number) => `<strong>${osu.trans(`users.show.extra.historical.${attribute}.count_label`)}</strong> ${escape(osu.formatNumber(d))}`,
        marginRight: 60, // more spacing for x axis label
        modifiers: 'profile-page',
      });

      chart = this.charts[attribute] = new LineChart(area, options);
    }

    const definedChart = chart;

    core.reactTurbolinks.runAfterPageLoad(this.id, () => {
      updateTicks(definedChart, data);
      definedChart.loadData(data);
    });
  };

  private updateCharts() {
    chartSections.forEach(this.updateChart);
  }
}
