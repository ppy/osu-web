// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'components/flag-country';
import Mod from 'components/mod';
import UserLink from 'components/user-link';
import { PlaylistItemJsonForMultiplayerEvent } from 'interfaces/playlist-item-json';
import { rulesets } from 'interfaces/ruleset';
import ScoreJson from 'interfaces/score-json';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { calculateStatisticsFor, rank } from 'utils/score-helper';
import { Data } from './content';

interface Props {
  data: Data;
  playlistItem: PlaylistItemJsonForMultiplayerEvent;
  score: ScoreJson;
  showTeam: boolean;
}

const firstRow = ['combo', 'accuracy', 'score'];

function renderVersion(props: Props) {
  const beatmap = props.data.beatmaps[props.score.beatmap_id];
  const version = beatmap?.version ?? trans('matches.match.beatmap-deleted');

  return (
    <a href={route('beatmaps.show', { beatmap: props.score.beatmap_id })}>
      <span
        className={`fal fa-extra-mode-${rulesets[props.score.ruleset_id]}`}
      /> {version}
    </a>
  );
}

export default observer(function Score(props: Props) {
  const user = props.data.users[props.score.user_id];

  if (user == null) {
    throw new Error('user for score is missing');
  }

  const team = props.playlistItem.details.teams?.[props.score.user_id] ?? 'none';

  return (
    <div className={classWithModifiers('mp-history-player-score', { team: props.showTeam })}>
      <div
        className='mp-history-player-score__shapes'
        style={{ backgroundImage: `url(/images/layout/mp-history/shapes-team-${team}.svg)` }} />
      <div className='mp-history-player-score__main'>
        <div className={classWithModifiers('mp-history-player-score__info-box', ['user'])}>
          <div className='mp-history-player-score__username-box'>
            <a
              className='mp-history-player-score__country-flag'
              href={route('rankings', {
                country: user.country?.code,
                mode: rulesets[props.score.ruleset_id],
                type: 'performance',
              })}
            >
              <FlagCountry country={user.country} modifiers={'medium'} />
            </a>

            <UserLink className='mp-history-player-score__username u-ellipsis-overflow' user={user} />
          </div>

          {props.playlistItem.freestyle && (
            <span className='mp-history-player-score__beatmap-version'>
              {renderVersion(props)}
            </span>
          )}
        </div>
        <div className={classWithModifiers('mp-history-player-score__info-box', 'mods')}>
          {props.score.mods.map((mod) => <Mod key={mod.acronym} mod={mod} />)}
        </div>
        <div className={classWithModifiers('mp-history-player-score__info-box', 'stats')}>
          <div className={classWithModifiers('mp-history-player-score__stat-row', 'first')}>
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
                  value = formatNumber(props.score.total_score);
                  break;
              }

              return (
                <div key={m} className={classWithModifiers('mp-history-player-score__stat', [m])}>
                  <span className='mp-history-player-score__stat-label'>{trans(`matches.match.score.stats.${m}`)}</span>
                  <span className={classWithModifiers('mp-history-player-score__stat-number', [modifier])}>{value}</span>
                </div>
              );
            })}
          </div>

          <div className='mp-history-player-score__stat-row'>
            {calculateStatisticsFor(props.score, 'leaderboard').map((stat) => (
              <div
                key={stat.label.short}
                className={classWithModifiers('mp-history-player-score__stat', 'small')}
              >
                <span className='mp-history-player-score__stat-label'>{stat.label.long}</span>
                <span className={classWithModifiers('mp-history-player-score__stat-number', ['small'])}>{formatNumber(stat.value)}</span>
              </div>
            ))}
          </div>
        </div>
        <div className={classWithModifiers('mp-history-player-score__info-box', 'rank')}>
          <div className={classWithModifiers('score-rank', 'profile-page', rank(props.score))} />
        </div>
      </div>
    </div>
  );
});
