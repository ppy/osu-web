// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'components/flag-country';
import Mod from 'components/mod';
import { LegacyMatchScoreJson } from 'interfaces/legacy-match-game-json';
import Ruleset from 'interfaces/ruleset';
import { ScoreStatisticsAttribute } from 'interfaces/score-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

interface Props {
  mode: Ruleset;
  score: LegacyMatchScoreJson;
  users: Partial<Record<number, UserJson>>;
}

const firstRow = ['combo', 'accuracy', 'score'];
const secondRow: ScoreStatisticsAttribute[] = ['count_geki', 'count_300', 'count_katu', 'count_100', 'count_50', 'count_miss'];

export default function Score(props: Props) {
  const user = props.users[props.score.user_id];

  if (user == null) {
    throw new Error('user for score is missing');
  }

  return (
    <div className='mp-history-game__player-score mp-history-player-score'>
      <div
        className='mp-history-player-score__shapes'
        style={{ backgroundImage: `url(/images/layout/mp-history/shapes-team-${props.score.match.team ?? 'none'}.svg)` }} />
      <div className='mp-history-player-score__main'>
        <div className={classWithModifiers('mp-history-player-score__info-box', ['user'])}>
          <div className='mp-history-player-score__username-box'>
            <a className='mp-history-player-score__username' href={route('users.show', { user: user.id })}>{user.username}</a>
            {!props.score.match.pass && <span className='mp-history-player-score__failed'>{trans('matches.match.failed')}</span>}
          </div>
          <a href={route('rankings', { country: user.country?.code, mode: props.mode, type: 'performance' })}>
            <FlagCountry country={user.country} modifiers={'medium'} />
          </a>
        </div>
        <div className={classWithModifiers('mp-history-player-score__info-box', ['stats'])}>
          <div className={classWithModifiers('mp-history-player-score__stat-row', ['first'])}>
            <div className='mp-history-player-score__mods'>
              {props.score.mods.map((mod) => <Mod key={mod} mod={{ acronym: mod }} />)}
            </div>
            {firstRow.map((m) => {
              let modifier = 'medium';
              let value;

              switch (m) {
                case 'combo':
                  value = formatNumber(props.score.max_combo);
                  break;

                case 'accuracy':
                  value = formatNumber(props.score.accuracy, 2, { style: 'percent' });
                  break;

                case 'score':
                  modifier = 'large';
                  value = formatNumber(props.score.score);
                  break;
              }

              return (
                <div key={m} className={classWithModifiers('mp-history-player-score__stat', [m])}>
                  <span className={classWithModifiers('mp-history-player-score__stat-label', ['small'])}>{trans(`matches.match.score.stats.${m}`)}</span>
                  <span className={classWithModifiers('mp-history-player-score__stat-number', [modifier])}>{value}</span>
                </div>
              );
            })}
          </div>

          <div className='mp-history-player-score__stat-row'>
            {secondRow.map((m) => {
              if (props.mode !== 'mania' && (m === 'count_geki' || m === 'count_katu')) {
                return null;
              }

              return (
                <div key={m} className={classWithModifiers('mp-history-player-score__stat', ['small'])}>
                  <span className={classWithModifiers('mp-history-player-score__stat-label', ['large'])}>{trans(`common.score_count.${m}`)}</span>
                  <span className={classWithModifiers('mp-history-player-score__stat-number', ['small'])}>{formatNumber(props.score.statistics[m])}</span>
                </div>
              );
            })}
          </div>
        </div>
      </div>
    </div>
  );
}
