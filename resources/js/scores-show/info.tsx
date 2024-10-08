// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetCover from 'components/beatmapset-cover';
import { SoloScoreJsonForShow } from 'interfaces/solo-score-json';
import * as React from 'react';
import { rulesetName } from 'utils/beatmap-helper';
import { accuracy, rank, rankCutoffs } from 'utils/score-helper';
import Buttons from './buttons';
import Dial from './dial';
import Player from './player';
import Tower from './tower';

interface Props {
  score: SoloScoreJsonForShow;
}

export default function Info({ score }: Props) {
  return (
    <div className='score-info'>
      <div className='score-info__cover'>
        <BeatmapsetCover beatmapset={score.beatmapset} modifiers='full' size='cover' />
      </div>

      <div className='score-info__item'>
        <Tower rank={rank(score)} />
      </div>

      <div className='score-info__item score-info__item--dial'>
        <Dial accuracy={accuracy(score)} mode={rulesetName(score.ruleset_id)} rank={rank(score)} rank_cutoffs={rankCutoffs(score)} />
      </div>

      <div className='score-info__item score-info__item--player'>
        <Player score={score} />
      </div>

      <div className='score-info__item score-info__item--buttons'>
        <Buttons score={score} />
      </div>
    </div>
  );
}
