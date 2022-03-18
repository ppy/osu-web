// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import { ScoreJsonForShow } from 'interfaces/score-json';
import * as React from 'react';
import BeatmapInfo from './beatmap-info';
import Info from './info';
import Stats from './stats';

interface Props {
  score: ScoreJsonForShow;
}

export default function Main(props: Props) {
  const beatmap = props.score.beatmap;
  const beatmapset = props.score.beatmapset;

  return (
    <>
      <HeaderV4 />

      <div className='osu-page osu-page--generic-compact'>
        <BeatmapInfo beatmap={beatmap} beatmapset={beatmapset} />

        <Info score={props.score} />

        <Stats beatmap={beatmap} score={props.score} />
      </div>
    </>
  );
}
