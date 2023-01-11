// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import LazyLoad from 'components/lazy-load';
import ProfilePageExtraSectionTitle from 'components/profile-page-extra-section-title';
import ShowMoreLink from 'components/show-more-link';
import { sortBy, times } from 'lodash';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as moment from 'moment';
import * as React from 'react';
import { trans } from 'utils/lang';
import BeatmapPlaycount from './beatmap-playcount';
import Chart, { ChartData } from './chart';
import ExtraHeader from './extra-header';
import ExtraPageProps, { HistoricalSection } from './extra-page-props';
import PlayDetailList from './play-detail-list';

const chartSections = ['monthly_playcounts', 'replays_watched_counts'] as const;
type ChartSection = typeof chartSections[number];

// conveniently both charts share same interface
interface RawChartData {
  count: number;
  start_date: string;
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
    // use UTC to prevent wrong month calculation on timezone with DST
    const missingMonths = moment.utc(entry.x).diff(moment.utc(lastEntry.x), 'months') - 1;

    times(missingMonths, (i) => {
      padded.push({
        x: moment.utc(lastEntry.x).add(i + 1, 'months').toDate(),
        y: 0,
      });
    });
  }

  padded.push(entry);

  return padded;
}

@observer
export default class Historical extends React.Component<ExtraPageProps> {
  @computed
  private get data() {
    return this.props.controller.state.lazy.historical;
  }

  @computed
  private get hasData() {
    return this.data != null;
  }

  @computed
  private get monthlyPlaycountsData() {
    return convertUserDataForChart(this.data?.monthly_playcounts ?? []);
  }

  @computed
  private get replaysWatchedCountsData() {
    return convertUserDataForChart(this.data?.replays_watched_counts ?? []);
  }

  constructor(props: ExtraPageProps) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.controller.withEdit} />

        <LazyLoad hasData={this.hasData} name={this.props.name} onLoad={this.handleOnLoad}>
          {this.renderHistorical()}
        </LazyLoad>
      </div>
    );
  }

  private readonly handleOnLoad = () => this.props.controller.get('historical');

  private hasSection(attribute: ChartSection) {
    return this.data != null && this.data[attribute].length > 0;
  }

  private readonly onShowMore = (section: HistoricalSection) => {
    this.props.controller.apiShowMore(section);
  };

  private renderHistorical() {
    if (this.data == null) return;

    return (
      <>
        {this.hasSection('monthly_playcounts') &&
          <>
            <ProfilePageExtraSectionTitle titleKey='users.show.extra.historical.monthly_playcounts.title' />

            <div className='page-extra__chart'>
              <Chart data={this.monthlyPlaycountsData} labelY={`${trans('users.show.extra.historical.monthly_playcounts.count_label')}`} />
            </div>
          </>
        }

        <ProfilePageExtraSectionTitle
          count={this.data.beatmap_playcounts.count}
          titleKey='users.show.extra.historical.most_played.title'
        />

        {this.data.beatmap_playcounts.count > 0 &&
          <>
            {this.data.beatmap_playcounts.items.map((playcount) => (
              <BeatmapPlaycount
                key={playcount.beatmap_id}
                currentMode={this.props.controller.currentMode}
                playcount={playcount}
              />
            ))}
            <ShowMoreLink
              {...this.data.beatmap_playcounts.pagination}
              callback={this.onShowMore}
              data={'beatmapPlaycounts' as const}
              modifiers='profile-page'
            />
          </>
        }

        <PlayDetailList controller={this.props.controller} section='scoresRecent' />

        {this.hasSection('replays_watched_counts') &&
          <>
            <ProfilePageExtraSectionTitle titleKey='users.show.extra.historical.replays_watched_counts.title' />

            <div className='page-extra__chart'>
              <Chart data={this.replaysWatchedCountsData} labelY={`${trans('users.show.extra.historical.replays_watched_counts.count_label')}`} />
            </div>
          </>
        }
      </>
    );
  }
}
