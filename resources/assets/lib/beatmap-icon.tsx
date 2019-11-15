/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
      <div className='beatmap-icon__shadow' />
      <i className={`fal fa-extra-mode-${mode}`} />
    </div>
  );
};
