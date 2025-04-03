// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { UserCard } from 'components/user-card';
import BeatmapJson from 'interfaces/beatmap-json';
import { SoloScoreJsonForShow } from 'interfaces/solo-score-json';
import * as React from 'react';
import PpValue from 'scores/pp-value';
import { rulesetName, shouldShowPp } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { accuracy, isPerfectCombo, calculateStatisticsForLeaderboard } from 'utils/score-helper';

interface Props {
  beatmap: BeatmapJson;
  score: SoloScoreJsonForShow;
}

export default function Stats(props: Props) {
  const scoreAccuracy = accuracy(props.score);

  return (
    <div className='score-stats'>
      <div className='score-stats__group score-stats__group--user-card'>
        <UserCard user={props.score.user} />
      </div>

      <div className='score-stats__group score-stats__group--stats'>
        <div className='score-stats__group-row'>
          <div className='score-stats__stat'>
            <div className='score-stats__stat-row score-stats__stat-row--label'>
              {trans('beatmapsets.show.scoreboard.headers.accuracy')}
            </div>
            <div className={classWithModifiers('score-stats__stat-row', { perfect: scoreAccuracy === 1 })}>
              {formatNumber(scoreAccuracy * 100, 2)}%
            </div>
          </div>

          <div className='score-stats__stat'>
            <div className='score-stats__stat-row score-stats__stat-row--label'>
              {trans('beatmapsets.show.scoreboard.headers.combo')}
            </div>
            <div className={classWithModifiers('score-stats__stat-row', { perfect: isPerfectCombo(props.score) })}>
              {formatNumber(props.score.max_combo)}x
            </div>
          </div>

          {shouldShowPp(props.beatmap) && (
            <div className='score-stats__stat'>
              <div className='score-stats__stat-row score-stats__stat-row--label'>
                {trans('beatmapsets.show.scoreboard.headers.pp')}
              </div>
              <div className='score-stats__stat-row'>
                <PpValue score={props.score} />
              </div>
            </div>
          )}
        </div>
        <div className='score-stats__group-row'>
          {calculateStatisticsForLeaderboard(rulesetName(props.score.ruleset_id), props.score).map((attr) => (
            <div key={attr.key} className='score-stats__stat'>
              <div className='score-stats__stat-row score-stats__stat-row--label'>
                {attr.label}
              </div>
              <div className='score-stats__stat-row'>
                {formatNumber(attr.total)}
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
