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

const tiers = [
  ['Bronze', [
    ['I', 1],
    ['II', 0.98],
    ['III', 0.96],
  ]],

  ['Silver', [
    ['I', 0.95],
    ['II', 0.875],
    ['III', 0.8],
  ]],

  ['Gold', [
    ['I', 0.75],
    ['II', 0.65],
    ['III', 0.55],
  ]],

  ['Platinum', [
    ['I', 0.5],
    ['II', 0.4],
    ['III', 0.3],
  ]],

  ['Rhodium', [
    ['I', 0.2],
    ['II', 0.15],
    ['III', 0.1],
  ]],

  ['Radiant', [
    ['I', 0.05],
    ['II', 0.025],
    ['III', 0.01],
  ]],
] as const;

function tier(stats: ProfilePageMatchmakingStatsJson) {
  const rank = stats.rank;
  const percent = stats.rank_percent;

  if (rank <= 100) {
    return { colour: 'lustrous', title: 'Lustrous' };
  }

  for (let i = tiers.length - 1; i >= 0; i--) {
    const [mainTitle, levels] = tiers[i];
    for (let j = levels.length - 1; j >= 0; j--) {
      const [level, minPercent] = levels[j];
      if (percent <= minPercent) {
        return {
          colour: mainTitle.toLowerCase(),
          title: `${mainTitle} ${level}`,
        };
      }
    }
  }

  // this shouldn't be reachable
  throw new Error('no matching tier');
}

function poolDisplayName(pool: MatchmakingPoolJson) {
  const variantName = rulesetVariantIdToName[pool.variant_id];

  const prefix = variantName === ''
    ? ''
    : `[${variantName}] `;

  return `${prefix}${pool.name}`;
}

function rankText(stats: null | ProfilePageMatchmakingStatsJson) {
  return stats == null
    ? '-'
    : (
      <span
        className='u-fancy-text'
        style={{
          '--colour': `var(--level-tier-${tier(stats).colour})`,
        } as React.CSSProperties}
      >
        #{formatNumber(stats.rank)}
      </span>
    );
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
          {trans('rankings.matchmaking.rating')}
        </div>
      </div>
      {sortedStats.map((stats) => (
        <div key={stats.pool_id} className='matchmaking-popup__row'>
          <div className='matchmaking-popup__key'>
            {poolDisplayName(stats.pool)}
          </div>
          <div className='matchmaking-popup__value'>
            {rankText(stats)}
          </div>
          <div className='matchmaking-popup__value'>
            {formatNumber(stats.first_placements)}
          </div>
          <div className='matchmaking-popup__value'>
            {formatNumber(stats.plays)}
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

    let highestRankStats: null | ProfilePageMatchmakingStatsJson = null;
    for (const stats of this.props.allStats) {
      // only show active stats for profile page
      if (stats.pool.active && (highestRankStats == null || stats.rank < highestRankStats.rank)) {
        highestRankStats = stats;
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
          <div className='daily-challenge__value daily-challenge__value--plain'>
            {rankText(highestRankStats)}
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
