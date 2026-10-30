// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'components/flag-country';
import Mods from 'components/mods';
import UserLink from 'components/user-link';
import { PlaylistItemJsonForMultiplayerEvent } from 'interfaces/playlist-item-json';
import { rulesetNames } from 'interfaces/ruleset';
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
  position: number;
  requiredMods: Set<string>;
  score: ScoreJson;
  showTeam: boolean;
}

function renderVersion(props: Props) {
  const beatmap = props.data.beatmaps[props.score.beatmap_id];
  const version = beatmap?.version ?? trans('matches.match.beatmap-deleted');

  return (
    <a className='u-hover' href={route('beatmaps.show', { beatmap: props.score.beatmap_id })}>
      <span
        className={`fal fa-extra-mode-${rulesetNames[props.score.ruleset_id]}`}
      /> {version}
    </a>
  );
}

export default observer(function Score(props: Props) {
  const user = props.data.users[props.score.user_id];

  if (user == null) {
    throw new Error('user for score is missing');
  }

  const team = props.playlistItem.details.teams?.[props.score.user_id] ?? 'blue';

  const extraMods = props.score.mods.filter((mod) => !props.requiredMods.has(mod.acronym));

  const positionModifier = !props.showTeam && props.position <= 3 ? `position-${props.position}` : null;

  return (
    <div className={classWithModifiers('mp-history-player-score', [props.showTeam ? 'team' : 'position', positionModifier])}>
      {props.score.type === 'solo_score' &&
        <a
          className='mp-history-player-score__score-link'
          href={route('scores.show', { score: props.score.id })}
        />
      }
      <div className={classWithModifiers('mp-history-player-score__team-indicator', team)} />
      <div className='mp-history-player-score__main'>
        <div className={classWithModifiers('mp-history-player-score__info-box', ['position', positionModifier])}>
          {!props.showTeam && <span className={classWithModifiers('mp-history-player-score__value')}>
            #{formatNumber(props.position)}
          </span>}
        </div>
        <div className={classWithModifiers('mp-history-player-score__info-box', 'rank')}>
          <div className={classWithModifiers('score-rank', rank(props.score))} />
        </div>
        <div className={classWithModifiers('mp-history-player-score__info-box', ['score'])}>
          <span className={classWithModifiers('mp-history-player-score__value-label')}>
            {trans('matches.match.score.stats.score')}
          </span>
          <span className={classWithModifiers('mp-history-player-score__value')}>
            {formatNumber(props.score.total_score)}
          </span>
        </div>
        <div className={classWithModifiers('mp-history-player-score__info-box', ['accuracy'])}>
          <span className={classWithModifiers('mp-history-player-score__value-label')}>
            {trans('matches.match.score.stats.accuracy')}
          </span>
          <span className={classWithModifiers('mp-history-player-score__value', { perfect: props.score.accuracy === 1 })}>
            {formatNumber(props.score.accuracy, 2, { style: 'percent' })}
          </span>
        </div>
        <div className={classWithModifiers('mp-history-player-score__info-box', ['user'])}>
          <div className='mp-history-player-score__username-box'>
            <a
              className='mp-history-player-score__country-flag u-hover'
              href={route('rankings', {
                country: user.country?.code,
                mode: rulesetNames[props.score.ruleset_id],
                type: 'performance',
              })}
            >
              <FlagCountry country={user.country} modifiers={'medium'} />
            </a>

            <UserLink className='mp-history-player-score__username u-hover' user={user} />
          </div>

          {props.playlistItem.freestyle && (
            <span className='mp-history-player-score__beatmap-version'>
              {renderVersion(props)}
            </span>
          )}
        </div>
        <div className={classWithModifiers('mp-history-player-score__info-box', ['combo'])}>
          <span className={classWithModifiers('mp-history-player-score__value-label')}>
            {trans('matches.match.score.stats.combo')}
          </span>
          <span className={classWithModifiers('mp-history-player-score__value', { perfect: props.score.is_perfect_combo })}>
            {formatNumber(props.score.max_combo)}x
          </span>
        </div>
        <div className={classWithModifiers('mp-history-player-score__info-box', 'stats')}>
          <div className='mp-history-player-score__stat-row'>
            {calculateStatisticsFor(props.score, 'leaderboard').map((stat) => (
              <div
                key={stat.label.short}
                className={classWithModifiers('mp-history-player-score__stat', `hit-${stat.attribute}`)}
              >
                <span className='mp-history-player-score__stat-label'>{stat.label.short}</span>
                <span className={classWithModifiers('mp-history-player-score__stat-number', { zero: stat.value === 0 })}>{formatNumber(stat.value)}</span>
              </div>
            ))}
          </div>
        </div>
        <div className={`${classWithModifiers('mp-history-player-score__info-box', 'mods')} u-hover`}>
          {props.score.mods.length > 0 && <span className={classWithModifiers('mp-history-player-score__value-label')}>
            {trans('matches.match.score.stats.free_mods')}
          </span>}
          <Mods mods={extraMods} />
        </div>
      </div>
    </div>
  );
});
