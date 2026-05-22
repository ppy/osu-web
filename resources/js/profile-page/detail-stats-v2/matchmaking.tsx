// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MatchmakingTierBadge from 'components/matchmaking-tier-badge';
import ValueDisplay from 'components/value-display';
import { rulesetIds, rulesetVariantIdToName } from 'interfaces/ruleset';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import Controller from 'profile-page/controller';
import { ProfilePageMatchmakingStatsJson } from 'profile-page/extra-page-props';
import { getHighestRankStats, tier } from 'profile-page/matchmaking';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { fail } from 'utils/fail';
import { formatNumber, htmlElementOrNull } from 'utils/html';
import { trans } from 'utils/lang';
import { getInt } from 'utils/math';
import MatchmakingChart from './matchmaking-chart';

interface Props {
  controller: Controller;
}

@observer
export default class Matchmaking extends React.PureComponent<Props> {
  private get allStats() {
    return this.props.controller.state.user.matchmaking_stats;
  }

  private get blankStats(): ProfilePageMatchmakingStatsJson {
    return {
      first_placements: 0,
      is_rating_provisional: true,
      plays: 0,
      pool: {
        active: true,
        id: 0,
        name: '',
        ruleset_id: rulesetIds[this.props.controller.currentMode],
        variant_id: 0,
      },
      pool_id: 0,
      rank: -1,
      rank_percent: 1,
      rating: 0,
      recent_history: [],
      total_points: 0,
      user_id: this.props.controller.state.user.id,
    };
  }

  @computed
  private get stats() {
    const currentPoolId = this.props.controller.state.matchmakingPoolId;
    if (currentPoolId == null) {
      const highestRankStats = getHighestRankStats(this.allStats)
        ?? this.blankStats;

      this.props.controller.state.matchmakingPoolId = highestRankStats.pool_id;

      return highestRankStats;
    } else {
      return this.allStats.find((s) => s.pool_id === currentPoolId)
        ?? this.blankStats;
    }
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    const stats = this.stats;

    if (stats.recent_history == null) {
      return null;
    }

    const [rankValue, tierData] = stats.rank === -1
      ? ['-', null]
      : [`#${formatNumber(stats.rank)}`, tier(stats)];
    const rankValueStyle = tierData == null
      ? undefined
      : {
        '--colour': `var(--level-tier-${tierData.colour})`,
      } as React.CSSProperties;

    return (
      <div className='profile-detail-stats-card profile-detail-stats-card--matchmaking'>
        <div className='profile-detail-stats-card__top'>
          {tierData != null &&
            <div className='profile-detail-stats-card__matchmaking-tier-badge'>
              <MatchmakingTierBadge
                rank={stats.rank}
                rulesetId={stats.pool.ruleset_id}
                tier={tierData.title}
              />
            </div>
          }
          <div className='profile-detail-stats-card__title'>
            <div className='profile-detail-stats-card__title-icon'>
              <span className='svg-icon svg-icon--multi' />
            </div>
            <div>
              {trans('users.show.matchmaking.title')}
              {this.renderVariantSelector()}
            </div>
          </div>
          <div className='profile-detail-stats-card__values profile-detail-stats-card__values--matchmaking-rating'>
            <ValueDisplay
              label={trans('users.show.matchmaking.rank')}
              modifiers='rank'
              value={
                <div
                  className={classWithModifiers('rank-value', tierData?.colour ?? 'base')}
                  style={rankValueStyle}
                >
                  {rankValue}
                </div>
              }
            />
            <div />
            <ValueDisplay
              label={trans('users.show.matchmaking.rating')}
              modifiers='rank rank-small'
              value={formatNumber(stats.rating)}
            />
            <ValueDisplay
              label={trans('users.show.matchmaking.tier')}
              modifiers='rank rank-small'
              value={tierData?.title ?? '-'}
            />
          </div>
          <div className='profile-detail-stats-card__values profile-detail-stats-card__values--matchmaking-matches'>
            <ValueDisplay
              label={trans('users.show.matchmaking.plays')}
              modifiers='plain'
              value={formatNumber(stats.plays)}
            />
            <ValueDisplay
              label={trans('users.show.matchmaking.wins')}
              modifiers='plain'
              value={formatNumber(stats.first_placements)}
            />
            <ValueDisplay
              label={trans('users.show.matchmaking.losses')}
              modifiers='plain'
              value={formatNumber(stats.plays - stats.first_placements)}
            />
          </div>
        </div>

        <div className='profile-detail-stats-card__middle profile-detail-stats-card__middle--matchmaking-play'>
          <div className='matchmaking-result'>
            <div className='matchmaking-result__title'>Latest Match History</div>
            <div className='matchmaking-result__icons'>
              {stats.recent_history.map((entry) => (
                <div
                  key={entry.id}
                  className={classWithModifiers('matchmaking-result-icon', `result-${entry.result}`)}
                />
              ))}
            </div>
          </div>
        </div>

        <div className='profile-detail-stats-card__bottom'>
          {stats.recent_history.length === 0
            ? (
              <div className='profile-detail-stats-card__empty-chart'>
                {trans('users.show.extra.unranked')}
              </div>
            ) : (
              <div key={stats.pool_id} className='profile-detail-stats-card__chart'>
                <MatchmakingChart controller={this.props.controller} poolId={stats.pool_id} />
              </div>
            )
          }
        </div>
        <div className='profile-detail-stats-card__decor-corner' />
        <div className='profile-detail-stats-card__decor' />
      </div>
    );
  }

  @action
  private readonly handleVariantSelectorClick = (e: React.MouseEvent) => {
    const poolId = getInt(htmlElementOrNull(e.currentTarget)?.dataset.poolId ?? '')
      ?? fail('element missing data-pool-id');

    this.props.controller.state.matchmakingPoolId = poolId;
  };

  private renderVariantSelector() {
    if (this.stats.pool.ruleset_id !== rulesetIds.mania) return null;

    if (this.allStats.length < 2) return null;

    const availableStats = this.allStats.slice();
    availableStats.sort((a, b) => a.pool.variant_id - b.pool.variant_id);

    return (
      <small className='profile-detail-stats-card__variants'>
        {availableStats.map((s) => (
          <button
            key={s.pool_id}
            className={classWithModifiers(
              'profile-detail-stats-card__variant',
              { active: s.pool_id === this.props.controller.state.matchmakingPoolId },
            )}
            data-pool-id={s.pool_id}
            onClick={this.handleVariantSelectorClick}
            type='button'
          >
            {rulesetVariantIdToName[s.pool.variant_id]}
          </button>
        ))}
      </small>
    );
  }
}
