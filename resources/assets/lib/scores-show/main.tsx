// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import { SoloScoreJsonForShow } from 'interfaces/solo-score-json';
import * as React from 'react';
import BeatmapInfo from './beatmap-info';
import Info from './info';
import Stats from './stats';

interface Props {
  score: SoloScoreJsonForShow;
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
      </div>
    </>
  );
}
