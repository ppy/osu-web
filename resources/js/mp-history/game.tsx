// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import LegacyMatchGameJson from 'interfaces/legacy-match-game-json';
import UserJson from 'interfaces/user-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans, transExists } from 'utils/lang';
import { TeamScores } from './content';
import GameHeader from './game-header';
import Score from './score';

interface Props {
  game: LegacyMatchGameJson;
  teamScores: TeamScores;
  users: Partial<Record<number, UserJson>>;
}

export default function Game(props: Props) {
  const showTeams = props.game.team_type === 'team-vs' || props.game.team_type === 'tag-team-vs';

  const winningTeam = props.teamScores.blue > props.teamScores.red ? 'blue' : 'red';
  const difference = Math.abs(props.teamScores.blue - props.teamScores.red);

  const sortedScores = props.game.scores.sort((first, second) => {
    if (first.match.team !== second.match.team) {
      return first.match.team === winningTeam ? -1 : 1;
    } else {
      return second.total_score - first.total_score;
    }
  });

  return (
    <div className='mp-history-game'>
      <GameHeader game={props.game} />
      <div className={classWithModifiers('mp-history-game__player-scores', { 'no-teams': showTeams })}>
        {sortedScores.map((score) => (
          <Score
            key={score.match.slot}
            mode={props.game.mode}
            score={score}
            users={props.users} />
        ))}
      </div>
      {showTeams && props.game?.end_time != null &&
        <div>
          <div className='mp-history-game__team-scores'>
            {(['red', 'blue'] as const).map((m) => (
              <div key={m} className={classWithModifiers('mp-history-game__team-score', [m])}>
                <span className={classWithModifiers('mp-history-game__team-score-text', ['name'])}>{trans(`matches.match.teams.${m}`)}</span>
                <span className={classWithModifiers('mp-history-game__team-score-text', ['score'])}>{formatNumber(props.teamScores[m])}</span>
              </div>
            ))}
          </div>
          <div className='mp-history-game__results'>
            <span className='mp-history-game__results-text'>
              <StringWithComponent
                mappings={{
                  difference: formatNumber(difference),
                  winner: (
                    <strong>
                      <StringWithComponent
                        mappings={{ team: trans(`matches.match.teams.${winningTeam}`) }}
                        pattern={winnerTrans()} />
                    </strong>
                  ),
                }}
                pattern={trans('matches.match.winner_by')} />
            </span>
          </div>
        </div>
      }
    </div>
  );
}

// Prevent partial translation for winner_by's :winner pattern.
function winnerTrans(): string {
  const locale = transExists('matches.match.winner_by') ? undefined : fallbackLocale;
  return trans('matches.match.winner', {}, locale);
}
