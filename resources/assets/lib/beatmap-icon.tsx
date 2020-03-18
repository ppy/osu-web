// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as _ from 'lodash';
import * as React from 'react';
import { FunctionComponent } from 'react';

interface Props {
  beatmap: Beatmap;
  modifier?: string;
  overrideVersion?: boolean;
  showTitle?: boolean;
}

export const BeatmapIcon: FunctionComponent<Props> = ({beatmap, overrideVersion, showTitle = true, modifier}) => {
  const difficultyRating = overrideVersion || BeatmapHelper.getDiffRating(beatmap.difficulty_rating);
  const showTooltip = showTitle && overrideVersion == null;
  const mode = beatmap.convert ? 'osu' : beatmap.mode;

  let className = `beatmap-icon beatmap-icon--${difficultyRating} beatmap-icon--${modifier}`;
  if (showTooltip) {
    className += ' beatmap-icon--with-hover js-beatmap-tooltip';
  }

  return (
    <div
      className={className}
      data-beatmap-title={showTooltip ? beatmap.version : null}
      data-stars={_.round(beatmap.difficulty_rating, 2)}
      data-difficulty={difficultyRating}
    >
      <i className={`fal fa-extra-mode-${mode}`} />
    </div>
  );
};
