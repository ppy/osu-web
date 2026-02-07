// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MatchmakingPoolJson from 'interfaces/matchmaking-pool-json';
import { rulesetVariantIdToName } from 'interfaces/ruleset';
import { autorun } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { qtipPosition } from 'utils/qtip-helper';
import { ProfilePageMatchmakingStatsJson } from './extra-page-props';

function poolDisplayName(pool: MatchmakingPoolJson) {
  const variantName = rulesetVariantIdToName[pool.variant_id];

  const prefix = variantName === ''
    ? ''
    : `[${variantName}] `;

  return `${prefix}${pool.name}`;
}

function rankText(rank: null | number) {
  return rank == null ? '-' : `#${formatNumber(rank)}`;
}

function popup(allStats: ProfilePageMatchmakingStatsJson[]) {
  const sortedStats = allStats.slice().sort((a, b) => b.pool_id - a.pool_id);

  return (
    <div className='matchmaking-popup'>
      <div className='matchmaking-popup__row'>
        <div className='matchmaking-popup__key' />
        <div className='matchmaking-popup__value' />
        <div className='matchmaking-popup__value'>
          {trans('rankings.matchmaking.wins')}
        </div>
        <div className='matchmaking-popup__value'>
          {trans('rankings.matchmaking.plays')}
        </div>
        <div className='matchmaking-popup__value'>
          {trans('rankings.matchmaking.points')}
        </div>
        <div className='matchmaking-popup__value'>
          {trans('rankings.matchmaking.rating')}
        </div>
      </div>
      {sortedStats.map((stats) => (
        <div key={stats.pool_id} className='matchmaking-popup__row'>
          <div className='matchmaking-popup__key'>
            {poolDisplayName(stats.pool)}
          </div>
          <div className='matchmaking-popup__value'>
            {rankText(stats.rank)}
          </div>
          <div className='matchmaking-popup__value'>
            {formatNumber(stats.first_placements)}
          </div>
          <div className='matchmaking-popup__value'>
            {formatNumber(stats.plays)}
          </div>
          <div className='matchmaking-popup__value'>
            {formatNumber(stats.total_points)}
          </div>
          <div className='matchmaking-popup__value'>
            {formatNumber(stats.rating)}{stats.is_rating_provisional ? '*' : ''}
          </div>
        </div>
      ))}
    </div>
  );
}

interface Props {
  allStats: ProfilePageMatchmakingStatsJson[];
}

@observer
export default class Matchmaking extends React.Component<Props> {
  private disposer?: () => void;
  private readonly valueRef = React.createRef<HTMLDivElement>();

  componentWillUnmount() {
    this.disposer?.();
  }

  render() {
    if (this.props.allStats.length === 0) {
      return null;
    }
    let highestRank: null | number = null;
    for (const stats of this.props.allStats) {
      const rank = stats.rank;
      // only show active stats for profile page
      if (stats.pool.active && rank != null) {
        if (highestRank == null) {
          highestRank = rank;
        } else if (rank < highestRank) {
          highestRank = rank;
        }
      }
    }

    return (
      <div
        ref={this.valueRef}
        className='daily-challenge'
        onMouseOver={this.onMouseOver}
      >
        <div className='daily-challenge__name'>
          {trans('users.show.matchmaking.title')}
        </div>
        <div className='daily-challenge__value-box'>
          <div className='daily-challenge__value'>
            {rankText(highestRank)}
          </div>
        </div>
      </div>
    );
  }

  private readonly onMouseOver = (event: React.MouseEvent<HTMLDivElement>) => {
    if (this.disposer != null) return;

    $(this.valueRef.current ?? []).qtip({
      content: '[placeholder]',
      hide: {
        delay: 200,
        fixed: true,
      },
      overwrite: false,
      position: {
        ...qtipPosition('top left'),
        adjust: { scroll: false },
      },
      show: {
        delay: 200,
        event: event.type,
        ready: true,
      },
      style: {
        classes: 'qtip qtip--daily-challenge',
        tip: false,
      },
    }, event);

    this.disposer = autorun(() => {
      const content = renderToStaticMarkup(popup(this.props.allStats));
      $(this.valueRef.current ?? []).qtip('set', { 'content.text': content });
    });
  };
}
