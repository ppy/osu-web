// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DonutChart from 'components/donut-chart';
import ValueDisplay from 'components/value-display';
import UserModdingProfileJson from 'interfaces/user-modding-profile-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import ActivityHeatmap from './activity-heatmap';

const statusOrder = [
  'ranked',
  'approved',
  'qualified',
  'loved',
  'pending',
  'wip',
  'graveyard',
] as const;

type Status = typeof statusOrder[number];

const sideGroups = [
  ['guest_beatmapset_count', 'nominated_beatmapset_count'],
  ['beatmaps_modded_count', 'issues_resolved_count'],
] as const;

interface Props {
  user: UserModdingProfileJson;
}

interface State {
  hoveredStatus: Status | null;
}

function kudosuRankTier(rank: number) {
  const tiers = [
    ['lustrous', 100],
    ['radiant', 200],
    ['rhodium', 300],
    ['platinum', 400],
    ['gold', 600],
    ['silver', 800],
    ['bronze', 1000],
  ] as const;

  for (const [tier, maxRank] of tiers) {
    if (rank <= maxRank) {
      return tier;
    }
  }

  return null;
}

// var(--beatmapset-graveyard-bg-hsl) is too dark to use here
function statusColour(status: Status) {
  return status === 'graveyard'
    ? 'var(--beatmapset-graveyard-colour)'
    : `hsl(var(--beatmapset-${status}-bg-hsl))`;
}

export default class Stats extends React.PureComponent<Props, State> {
  state: State = { hoveredStatus: null };

  render() {
    const { user } = this.props;
    const rank = user.kudosu.rank;
    const tier = rank == null ? null : kudosuRankTier(rank);
    const hoveredStatus = this.state.hoveredStatus;
    const visibleStatuses = statusOrder.filter((status) => user.beatmapset_status_counts[status] > 0);
    const slices = visibleStatuses.map((status) => ({
      colour: statusColour(status),
      key: status,
      value: user.beatmapset_status_counts[status],
    }));

    return (
      <div className='modding-profile-stats'>
        <div className='profile-detail-stats-card profile-detail-stats-card--modding'>
          <div className='profile-detail-stats-card__top profile-detail-stats-card__top--modding'>
            <div className='profile-detail-stats-card__title'>
              <div className='profile-detail-stats-card__title-icon'>
                <span className='svg-icon svg-icon--stats' />
              </div>
              <div>
                {trans('users.show.stats.title')}
              </div>
            </div>
            <div className='profile-detail-stats-card__values'>
              <ValueDisplay
                label={trans('users.show.rank.kudosu_simple')}
                modifiers='rank'
                value={
                  <div
                    className={classWithModifiers('rank-value', tier ?? 'base')}
                    data-html-title={rank == null ? trans('users.show.rank.kudosu_outside_top_1000') : undefined}
                    data-tooltip-position='bottom left'
                    style={tier == null ? undefined : {
                      '--colour': `var(--level-tier-${tier})`,
                    } as React.CSSProperties}
                    title=''
                  >
                    {rank != null ? `#${formatNumber(rank)}` : '-'}
                  </div>
                }
              />
              <ValueDisplay
                label={trans('users.show.extra.kudosu.total')}
                modifiers='rank rank-small'
                value={formatNumber(user.kudosu.total)}
              />
            </div>
          </div>

          {slices.length > 0 ? (
            <div className='modding-profile-stats__body'>
              <ul className='modding-profile-stats__legend' onMouseLeave={this.onHoverEnd}>
                {visibleStatuses.map((status) => (
                  <li
                    key={status}
                    className={classWithModifiers('modding-profile-stats__legend-item', {
                      dimmed: hoveredStatus != null && hoveredStatus !== status,
                      highlighted: hoveredStatus === status,
                    })}
                    data-status={status}
                    onMouseEnter={this.onLegendEnter}
                  >
                    <span className='modding-profile-stats__label'>
                      <span
                        className='modding-profile-stats__swatch'
                        style={{ '--colour': statusColour(status) } as React.CSSProperties}
                      />
                      {trans(`users.show.stats.${status}_beatmapset_count`)}
                    </span>
                    <span className='modding-profile-stats__value'>
                      {formatNumber(user.beatmapset_status_counts[status])}
                    </span>
                  </li>
                ))}
              </ul>

              <div className='modding-profile-stats__chart'>
                <DonutChart
                  hoveredKey={hoveredStatus}
                  onHover={this.onSliceHover}
                  slices={slices}
                />
              </div>
            </div>
          ) : (
            <div className='modding-profile-stats__body modding-profile-stats__body--empty'>
              {trans('users.show.stats.empty').split('\\n').map((line, i) => (
                <div key={i}>{line}</div>
              ))}
            </div>
          )}

          <div className='profile-detail-stats-card__decor-corner' />
          <div className='profile-detail-stats-card__decor' />
        </div>

        <div className='modding-profile-stats__counts'>
          {sideGroups.map((group) => (
            <div key={group[0]} className='profile-stats'>
              {group.map((key) => (
                <dl key={key} className='profile-stats__entry'>
                  <dt className='profile-stats__key'>{trans(`users.show.stats.${key}`)}</dt>
                  <dd className='profile-stats__value'>{formatNumber(user[key])}</dd>
                </dl>
              ))}
            </div>
          ))}
        </div>

        <div className='modding-profile-stats__heatmap'>
          <ActivityHeatmap heatmap={user.modding_activity_heatmap} />
        </div>
      </div>
    );
  }

  private readonly onHoverEnd = () => {
    this.setState({ hoveredStatus: null });
  };

  private readonly onLegendEnter = (event: React.MouseEvent<HTMLLIElement>) => {
    this.setState({ hoveredStatus: event.currentTarget.dataset.status as Status });
  };

  private readonly onSliceHover = (key: string | null) => {
    this.setState({ hoveredStatus: key as Status | null });
  };
}
