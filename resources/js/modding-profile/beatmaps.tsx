// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DonutChart from 'components/donut-chart';
import UserModdingProfileJson from 'interfaces/user-modding-profile-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

const bn = 'modding-profile-beatmaps';

const chartKeys = [
  'ranked',
  'approved',
  'qualified',
  'loved',
  'pending',
  'wip',
  'graveyard',
  'guest',
] as const;

type ChartKey = typeof chartKeys[number];

interface Props {
  user: UserModdingProfileJson;
}

interface State {
  hoveredKey: ChartKey | null;
}

function chartColour(key: ChartKey) {
  switch (key) {
    case 'approved':
      return 'hsl(var(--hsl-lime-3))';
    case 'guest':
      return 'hsl(var(--hsl-blue-3))';
    case 'graveyard':
      return 'var(--beatmapset-graveyard-colour)';
    default:
      return `hsl(var(--beatmapset-${key}-bg-hsl))`;
  }
}

function chartValue(user: UserModdingProfileJson, key: ChartKey) {
  return key === 'guest'
    ? user.guest_beatmapset_count
    : user.beatmapset_status_counts[key];
}

export default class Beatmaps extends React.PureComponent<Props, State> {
  state: State = { hoveredKey: null };

  render() {
    return (
      <div className='profile-detail-stats-card profile-detail-stats-card--beatmaps'>
        <div className='profile-detail-stats-card__top profile-detail-stats-card__top--beatmaps'>
          <div className='profile-detail-stats-card__title'>
            <div className='profile-detail-stats-card__title-icon'>
              <span className='svg-icon svg-icon--stats' />
            </div>
            <div>
              {trans('users.show.beatmaps.title')}
            </div>
          </div>
        </div>
        {this.renderBody()}
      </div>
    );
  }

  private readonly onHoverEnd = () => {
    this.setState({ hoveredKey: null });
  };

  private readonly onLegendEnter = (event: React.MouseEvent<HTMLLIElement>) => {
    this.setState({ hoveredKey: event.currentTarget.dataset.sliceKey as ChartKey });
  };

  private readonly onSliceHover = (key: string | null) => {
    this.setState({ hoveredKey: key as ChartKey | null });
  };

  private renderBody() {
    const { user } = this.props;
    const hoveredKey = this.state.hoveredKey;
    const visibleKeys = chartKeys.filter((key) => chartValue(user, key) > 0);
    const empty = visibleKeys.length === 0;

    return (
      <div className={classWithModifiers(bn, { empty })}>
        {empty ? this.renderEmpty() : this.renderChart(visibleKeys, hoveredKey)}
      </div>
    );
  }

  private renderChart(visibleKeys: ChartKey[], hoveredKey: ChartKey | null) {
    const { user } = this.props;
    const slices = visibleKeys.map((key) => ({
      colour: chartColour(key),
      key,
      value: chartValue(user, key),
    }));

    return (
      <>
        <div className={`${bn}__chart`}>
          <DonutChart
            hoveredKey={hoveredKey}
            onHover={this.onSliceHover}
            slices={slices}
          />
        </div>

        <ul className={`${bn}__legend`} onMouseLeave={this.onHoverEnd}>
          {visibleKeys.map((key) => (
            <li
              key={key}
              className={classWithModifiers(`${bn}__legend-item`, {
                dimmed: hoveredKey != null && hoveredKey !== key,
                highlighted: hoveredKey === key,
              })}
              data-slice-key={key}
              onMouseEnter={this.onLegendEnter}
            >
              <span className={`${bn}__label`}>
                <span
                  className={`${bn}__swatch`}
                  style={{ '--colour': chartColour(key) } as React.CSSProperties}
                />
                {trans(`users.show.stats.${key}_beatmapset_count`)}
              </span>
              <span className={`${bn}__value`}>
                {formatNumber(chartValue(user, key))}
              </span>
            </li>
          ))}
        </ul>
      </>
    );
  }

  private renderEmpty() {
    return (
      <>
        <span className={`${bn}__empty-icon`}>
          <span className='fas fa-ghost' />
        </span>
        <div>
          {trans('users.show.beatmaps.empty').split('\\n').map((line, i) => (
            <div key={i}>{line}</div>
          ))}
        </div>
      </>
    );
  }
}
