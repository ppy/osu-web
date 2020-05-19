// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as _ from 'lodash';
import * as React from 'react';
import { FunctionComponent } from 'react';
import { getDiffRating } from 'utils/beatmap-helper';

interface Props {
  beatmap: BeatmapJsonExtended;
  modifier?: string;
  showTitle?: boolean;
}

export const BeatmapIcon: FunctionComponent<Props> = ({beatmap, showTitle = true, modifier}) => {
  const difficultyRating = getDiffRating(beatmap.difficulty_rating);
  const mode = beatmap.convert ? 'osu' : beatmap.mode;

  let className = `beatmap-icon beatmap-icon--${modifier}`;
  if (showTitle) {
    className += ' beatmap-icon--with-hover js-beatmap-tooltip';
  }

  const style = osu.diffColour(difficultyRating);

  return (
    <div
      className={className}
      data-beatmap-title={showTitle ? beatmap.version : null}
      data-stars={_.round(beatmap.difficulty_rating, 2)}
      data-difficulty={difficultyRating}
      style={style}
    >
      <i className={`fal fa-extra-mode-${mode}`} />
    </div>
  );
};
