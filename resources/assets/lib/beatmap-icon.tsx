// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as _ from 'lodash';
import * as React from 'react';
import { getDiffColour, getDiffRating } from 'utils/beatmap-helper';

interface Props {
  beatmap: BeatmapJsonExtended;
  modifier?: string;
  showConvertMode?: boolean;
  showTitle?: boolean;
}

export const BeatmapIcon = (props: Props) => {
  const {
    beatmap,
    modifier,
    showConvertMode = false,
    showTitle = true,
  } = props;

  const difficultyRating = getDiffRating(beatmap.difficulty_rating);
  const mode = beatmap.convert && !showConvertMode ? 'osu' : beatmap.mode;

  let className = 'beatmap-icon';
  // FIXME: update to use array of string instead
  if (modifier != null) {
    className += ` beatmap-icon--${modifier}`;
  }
  if (showTitle) {
    className += ' beatmap-icon--with-hover js-beatmap-tooltip';
  }

  const style = {
    '--diff': getDiffColour(beatmap.difficulty_rating),
  } as React.CSSProperties;

  return (
    <div
      className={className}
      data-beatmap-title={showTitle ? beatmap.version : null}
      data-difficulty={difficultyRating}
      data-stars={_.round(beatmap.difficulty_rating, 2)}
      style={style}
    >
      <i className={`fal fa-extra-mode-${mode}`} />
    </div>
  );
};
