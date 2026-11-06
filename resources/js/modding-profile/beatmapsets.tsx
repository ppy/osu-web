// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DonutChart from 'components/donut-chart';
import UserModdingProfileJson from 'interfaces/user-modding-profile-json';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

const bn = 'modding-profile-beatmapsets';

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
    : user.beatmapset_status_counts[key] ?? 0;
}

@observer
export default class Beatmapsets extends React.PureComponent<Props> {
  @observable private hoveredKey: ChartKey | null = null;

  @computed
  private get slices() {
    return chartKeys
      .filter((key) => chartValue(this.props.user, key) > 0)
      .map((key) => ({
        colour: chartColour(key),
        key,
        value: chartValue(this.props.user, key),
      }));
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    return (
      <div className='profile-detail-stats-card profile-detail-stats-card--beatmapsets'>
        <div className='profile-detail-stats-card__top profile-detail-stats-card__top--beatmapsets'>
          <div className='profile-detail-stats-card__title'>
            <div className='profile-detail-stats-card__title-icon'>
              <span className='svg-icon svg-icon--stats' />
            </div>
            <div>
              {trans('users.show.beatmapsets.title')}
            </div>
          </div>
          {this.slices.length === 0 ? this.renderEmpty() : this.renderChart()}
        </div>
      </div>
    );
  }

  @action
  private readonly onMouseEnter = (event: React.MouseEvent<HTMLElement | SVGPathElement>) => {
    this.hoveredKey = event.currentTarget.dataset.sliceKey as ChartKey ?? null;
  };

  @action
  private readonly onMouseLeave = () => {
    this.hoveredKey = null;
  };

  private renderChart() {
    const hoveredKey = this.hoveredKey;

    return (
      <div className={bn}>
        <div className={`${bn}__chart`}>
          <DonutChart
            hoveredKey={hoveredKey}
            onMouseEnter={this.onMouseEnter}
            onMouseLeave={this.onMouseLeave}
            slices={this.slices}
          />
        </div>

        <ul className={`${bn}__legend`} onMouseLeave={this.onMouseLeave}>
          {this.slices.map((slice) => (
            <li
              key={slice.key}
              className={classWithModifiers(`${bn}__legend-item`, {
                dimmed: hoveredKey != null && hoveredKey !== slice.key,
                highlighted: hoveredKey === slice.key,
              })}
              data-slice-key={slice.key}
              onMouseEnter={this.onMouseEnter}
            >
              <span className={`${bn}__label`}>
                <span
                  className={`${bn}__swatch`}
                  style={{ '--colour': slice.colour } as React.CSSProperties}
                />
                {trans(`users.show.stats.${slice.key}_beatmapset_count`)}
              </span>
              <span className={`${bn}__value`}>
                {formatNumber(slice.value)}
              </span>
            </li>
          ))}
        </ul>
      </div>
    );
  }

  private renderEmpty() {
    return (
      <div className={classWithModifiers(bn, 'empty')}>
        <span className={`${bn}__empty-icon`}>
          <span className='fas fa-ghost' />
        </span>
        <div>
          {trans('users.show.beatmapsets.empty').split('\\n').map((line, i) => (
            <div key={i}>{line}</div>
          ))}
        </div>
      </div>
    );
  }
}
