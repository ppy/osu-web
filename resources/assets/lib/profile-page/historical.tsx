// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import LineChart, { makeOptionsDate } from 'charts/line-chart';
import { curveLinear } from 'd3';
import { escape, sortBy, times } from 'lodash';
import { autorun, computed, makeObservable } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import * as moment from 'moment';
import core from 'osu-core-singleton';
import PlayDetailList from 'play-detail-list';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import { switchNever } from 'utils/switch-never';
import BeatmapPlaycount from './beatmap-playcount';
import ExtraHeader from './extra-header';
import ExtraPageProps, { HistoricalSection } from './extra-page-props';

const chartSections = ['monthly_playcounts', 'replays_watched_counts'] as const;
type ChartSection = typeof chartSections[number];

// conveniently both charts share same interface
interface RawChartData {
  count: number;
  start_date: string;
}

interface ChartData {
  x: Date;
  y: number;
}

function convertUserDataForChart(rawData: RawChartData[]): ChartData[] {
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

  return data;
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

function updateTicks(chart: LineChart<Date>, data: ChartData[]) {
  if (core.windowSize.isDesktop) {
    chart.options.ticksX = undefined;

    chart.options.tickValuesX = data.length < 10 ? data.map((d) => d.x) : undefined;
  } else {
    chart.options.ticksX = Math.min(6, data.length);
    chart.options.tickValuesX = undefined;
  }
}

@observer
export default class Historical extends React.Component<ExtraPageProps> {
  private readonly chartRefs = {
    monthly_playcounts: React.createRef<HTMLDivElement>(),
    replays_watched_counts: React.createRef<HTMLDivElement>(),
  };
  private readonly charts: Partial<Record<ChartSection, LineChart<Date>>> = {};
  private readonly disposers = new Set<(() => void) | undefined>();

  @computed
  private get monthlyPlaycountsData() {
    return convertUserDataForChart(this.props.controller.state.user.monthly_playcounts);
  }

  @computed
  private get replaysWatchedCountsData() {
    return convertUserDataForChart(this.props.controller.state.user.replays_watched_counts);
  }

  constructor(props: ExtraPageProps) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    $(window).on('resize', this.resizeCharts);
    this.disposers.add(() => $(window).off('resize', this.resizeCharts));
    disposeOnUnmount(this, autorun(this.updateCharts));
  }

  componentWillUnmount() {
    this.disposers.forEach((disposer) => disposer?.());
  }

  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.controller.withEdit} />

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
            {osu.formatNumber(this.props.controller.state.user.beatmap_playcounts_count)}
          </span>
        </h3>

        {this.props.controller.state.extras.beatmapPlaycounts.length > 0 &&
          <>
            {this.props.controller.state.extras.beatmapPlaycounts.map((playcount) => (
              <BeatmapPlaycount
                key={playcount.beatmap_id}
                currentMode={this.props.controller.currentMode}
                playcount={playcount}
              />
            ))}
            <ShowMoreLink
              {...this.props.controller.state.pagination.beatmapPlaycounts}
              callback={this.onShowMore}
              data={'beatmapPlaycounts' as const}
              modifiers='profile-page'
            />
          </>
        }

        <h3 className='title title--page-extra-small'>
          {osu.trans('users.show.extra.historical.recent_plays.title')}
          <span className='title__count'>
            {osu.formatNumber(this.props.controller.state.user.scores_recent_count)}
          </span>
        </h3>

        {this.props.controller.state.extras.scoresRecent.length > 0 &&
          <>
            <PlayDetailList scores={this.props.controller.state.extras.scoresRecent} />

            <ShowMoreLink
              {...this.props.controller.state.pagination.scoresRecent}
              callback={this.onShowMore}
              data={'scoresRecent' as const}
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
    return this.props.controller.state.user[attribute].length > 0;
  }

  private readonly onShowMore = (section: HistoricalSection) => {
    this.props.controller.apiShowMore(section);
  };

  private readonly resizeCharts = () => {
    Object.values(this.charts).forEach((chart) => {
      chart.resize();
    });
  };

  private readonly updateChart = (attribute: ChartSection) => {
    if (!this.hasSection(attribute)) return;

    const area = this.chartRefs[attribute].current;

    if (area == null) {
      throw new Error("chart can't be updated before the component is mounted");
    }

    let data: ChartData[];
    switch (attribute) {
      case 'monthly_playcounts':
        data = this.monthlyPlaycountsData;
        break;
      case 'replays_watched_counts':
        data = this.replaysWatchedCountsData;
        break;
      default:
        switchNever(attribute);
        throw new Error('unsupported chart section');
    }

    let chart = this.charts[attribute];
    if (chart == null) {
      const options = makeOptionsDate({
        circleLine: true,
        curve: curveLinear,
        formatX: (d: Date) => moment.utc(d).format(osu.trans('common.datetime.year_month_short.moment')),
        formatY: (d: number) => osu.formatNumber(d),
        infoBoxFormatX: (d: Date) => moment.utc(d).format(osu.trans('common.datetime.year_month.moment')),
        infoBoxFormatY: (d: number) => `<strong>${osu.trans(`users.show.extra.historical.${attribute}.count_label`)}</strong> ${escape(osu.formatNumber(d))}`,
        marginRight: 60, // more spacing for x axis label
        modifiers: 'profile-page',
      });

      chart = this.charts[attribute] = new LineChart(area, options);
    }

    const definedChart = chart;

    this.disposers.add(core.reactTurbolinks.runAfterPageLoad(() => {
      updateTicks(definedChart, data);
      definedChart.loadData(data);
    }));
  };

  private readonly updateCharts = () => {
    chartSections.forEach(this.updateChart);
  };
}
