// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from 'interfaces/beatmap-json';
import ScoreJson from 'interfaces/score-json';
import * as osu from 'osu-common';
import * as React from 'react';
import PpValue from 'scores/pp-value';
import { UserCard } from 'user-card';
import { shouldShowPp } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';
import { modeAttributesMap } from 'utils/score';

interface Props {
  beatmap: BeatmapJson;
  score: ScoreJson;
}

export default function Stats(props: Props) {
  if (props.score.mode == null) {
    throw new Error('score json is missing mode');
  }

  return (
    <div className='score-stats'>
      <div className='score-stats__group score-stats__group--user-card'>
        <UserCard user={props.score.user} />
      </div>

      <div className='score-stats__group score-stats__group--stats'>
        <div className='score-stats__group-row'>
          <div className='score-stats__stat'>
            <div className='score-stats__stat-row score-stats__stat-row--label'>
              {osu.trans('beatmapsets.show.scoreboard.headers.accuracy')}
            </div>
            <div className={classWithModifiers('score-stats__stat-row', { perfect: props.score.accuracy === 1 })}>
              {osu.formatNumber(props.score.accuracy * 100, 2)}%
            </div>
          </div>

          <div className='score-stats__stat'>
            <div className='score-stats__stat-row score-stats__stat-row--label'>
              {osu.trans('beatmapsets.show.scoreboard.headers.combo')}
            </div>
            <div className={classWithModifiers('score-stats__stat-row', { perfect: props.score.max_combo === props.beatmap.max_combo })}>
              {osu.formatNumber(props.score.max_combo)}x
            </div>
          </div>

          {shouldShowPp(props.beatmap) && (
            <div className='score-stats__stat'>
              <div className='score-stats__stat-row score-stats__stat-row--label'>
                {osu.trans('beatmapsets.show.scoreboard.headers.pp')}
              </div>
              <div className='score-stats__stat-row'>
                <PpValue score={props.score} />
              </div>
            </div>
          )}
        </div>
        <div className='score-stats__group-row'>
          {modeAttributesMap[props.score.mode].map((attr) => (
            <div key={attr.attribute} className='score-stats__stat'>
              <div className='score-stats__stat-row score-stats__stat-row--label'>
                {attr.label}
              </div>
              <div className='score-stats__stat-row'>
                {props.score.statistics[attr.attribute]}
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
