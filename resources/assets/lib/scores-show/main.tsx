// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import ScoreJson from 'interfaces/score-json';
import * as React from 'react';
import BeatmapInfo from './beatmap-info';
import Info from './info';
import Stats from './stats';

interface Props {
  score: ScoreJson;
}

export default function Main(props: Props) {
  const beatmap = props.score.beatmap;
  const beatmapset = props.score.beatmapset;

  if (beatmap == null || beatmapset == null) {
    throw new Error('score json is missing beatmap or beatmapset details');
  }

  if (props.score.difficulty_rating != null) {
    beatmap.difficulty_rating = props.score.difficulty_rating;
  }

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
