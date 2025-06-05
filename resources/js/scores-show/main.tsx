// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import { ScoreJsonForShow } from 'interfaces/score-json';
import * as React from 'react';
import { trans } from 'utils/lang';
import BeatmapInfo from './beatmap-info';
import Info from './info';
import Stats from './stats';

interface Props {
  score: ScoreJsonForShow;
}

export default function Main({ score }: Props) {
  const { beatmap, beatmapset } = score;

  return (
    <>
      <HeaderV4 />

      <div className='osu-page osu-page--generic-compact'>
        <BeatmapInfo beatmap={beatmap} beatmapset={beatmapset} />

        <Info score={score} />

        <Stats beatmap={beatmap} score={score} />

        {score.type === 'solo_score' && !score.preserve && (
          <div className='wiki-notice wiki-notice--score'>
            <span className='fas fa-info-circle' />
            {` ${trans('scores.show.non_preserved')}`}
          </div>
        )}
      </div>
    </>
  );
}
