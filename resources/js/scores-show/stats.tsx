// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { UserCard } from 'components/user-card';
import BeatmapJson from 'interfaces/beatmap-json';
import { SoloScoreJsonForShow } from 'interfaces/solo-score-json';
import * as React from 'react';
import PpValue from 'scores/pp-value';
import { shouldShowPp } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { accuracy, isPerfectCombo, calculateStatisticsFor } from 'utils/score-helper';

interface Props {
  beatmap: BeatmapJson;
  score: SoloScoreJsonForShow;
}

export default function Stats(props: Props) {
  const scoreAccuracy = accuracy(props.score);

  const statistics = calculateStatisticsFor(props.score, 'single');

  const basicStats = statistics.filter((attr) => attr.basic);
  // logic matches https://github.com/ppy/osu/blob/2df3dfb99cc867240f757c3761115b19d8595ec1/osu.Game/Scoring/ScoreInfo.cs#L373-L374
  const extraStats = statistics.filter((attr) => !attr.basic && attr.maximumValue != null && attr.maximumValue > 0);

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
          {basicStats
            .map((attr) => (
              <div key={attr.longLabel} className='score-stats__stat'>
                <div className='score-stats__stat-row score-stats__stat-row--label'>
                  {attr.longLabel}
                </div>
                <div className='score-stats__stat-row'>
                  {formatNumber(attr.value)}
                </div>
              </div>
            ))}
        </div>
        {extraStats.length > 0
          ? <div className='score-stats__group-row'>
            {extraStats
              .map((attr) => (
                <div key={attr.longLabel} className='score-stats__stat'>
                  <div className='score-stats__stat-row score-stats__stat-row--label'>
                    {attr.longLabel}
                  </div>
                  <div className='score-stats__stat-row'>
                    {formatNumber(attr.value)}<span className='score-stats__stat-row--maximum'>/{formatNumber(attr.maximumValue!)}</span>
                  </div>
                </div>
              ))}
          </div>
          : null
        }
      </div>
    </div>
  );
}
