// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ScoreJsonForShow } from 'interfaces/score-json';
import * as React from 'react';
import Buttons from './buttons';
import Dial from './dial';
import Player from './player';
import Tower from './tower';

interface Props {
  score: ScoreJsonForShow;
}

export default function Info(props: Props) {
  const score = props.score;
  const beatmapset = props.score.beatmapset;

  return (
    <div
      className='score-info'
      style={{ backgroundImage: osu.urlPresence(beatmapset.covers.cover) }}
    >
      <div className='score-info__item'>
        <Tower rank={score.rank} />
      </div>

      <div className='score-info__item score-info__item--dial'>
        <Dial accuracy={score.accuracy} mode={score.mode} rank={score.rank} />
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
