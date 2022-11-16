// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapListItem from 'components/beatmap-list-item';
import StringWithComponent from 'components/string-with-component';
import { UserLink } from 'components/user-link';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import { route } from 'laroute';
import * as React from 'react';
import { getArtist, getTitle } from 'utils/beatmap-helper';
import { trans } from 'utils/lang';

interface Props {
  beatmap: BeatmapExtendedJson;
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
            {trans('scores.show.beatmap.by', { artist: getArtist(beatmapset) })}
          </span>
        </a>
      </h1>

      <div className='score-beatmap__detail'>
        <span className='u-ellipsis-overflow'>
          <a className='score-beatmap__link-plain' href={beatmapUrl}>
            <BeatmapListItem beatmap={beatmap} inline modifiers='score' />
          </a>

          {' '}
          <span className='score-beatmap__mapper'>
            <StringWithComponent
              mappings={{
                mapper: <UserLink user={{ id: beatmapset.user_id, username: beatmapset.creator }} />,
              }}
              pattern={trans('beatmapsets.show.details.mapped_by')}
            />
          </span>
        </span>
      </div>
    </div>
  );
};

export default BeatmapInfo;
