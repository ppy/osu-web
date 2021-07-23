// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'beatmap-icon';
import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import { route } from 'laroute';
import osu from 'osu-common';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';
import { UserLink } from 'user-link';
import { getArtist, getDiffRating, getTitle } from 'utils/beatmap-helper';

interface Props {
  beatmap: BeatmapJsonExtended;
  beatmapset: BeatmapsetJson;
}

const BeatmapInfo = (props: Props) => {
  const { beatmap, beatmapset } = props;
  const beatmapUrl = route('beatmaps.show', { beatmap: beatmap.id, mode: beatmap.mode });

  return (
    <div className='score-beatmap'>
      <h1 className='score-beatmap__title'>
        <a className='score-beatmap__link-plain' href={beatmapUrl}>
          {getTitle(beatmapset)}
          {' '}
          <span className='score-beatmap__artist'>
            {osu.trans('scores.show.beatmap.by', { artist: getArtist(beatmapset) })}
          </span>
        </a>
      </h1>

      <div className='score-beatmap__detail'>
        <span className='score-beatmap__detail-item'>
          <BeatmapIcon beatmap={beatmap} showConvertMode showTitle={false} />
        </span>

        <span className='score-beatmap__detail-item score-beatmap__detail-item--difficulty'>
          <span
            className='score-beatmap__star'
            style={osu.diffColour(getDiffRating(beatmap.difficulty_rating))}
          >
            <span className='fas fa-star' />
          </span>
          {osu.formatNumber(beatmap.difficulty_rating)}
        </span>

        <span className='score-beatmap__detail-item'>
          <a className='score-beatmap__link-plain' href={beatmapUrl}>
            {beatmap.version}
          </a>
          {' '}

          <span className='score-beatmap__mapper'>
            <StringWithComponent
              mappings={{
                ':mapper':
                  <UserLink
                    key='user'
                    user={{ id: beatmapset.user_id, username: beatmapset.creator }}
                  />,
              }}
              pattern={osu.trans('beatmapsets.show.details.mapped_by')}
            />
          </span>
        </span>
      </div>
    </div>
  );
};

export default BeatmapInfo;
