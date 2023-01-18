// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetCover from 'components/beatmapset-cover';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import { route } from 'laroute';
import * as React from 'react';
import { getArtist, getTitle } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

export default function Beatmapset({ beatmapset, modifiers = [] }: { beatmapset: BeatmapsetJson; modifiers?: string[] }) {
  const url = route('beatmapsets.show', { beatmapset: beatmapset.id });

  return (
    <a className={classWithModifiers('beatmapset-search-card', modifiers)} href={url}>
      <BeatmapsetCover beatmapset={beatmapset} modifiers='search' size='list' />
      <div className='beatmapset-search-card__details'>
        <div className='beatmapset-search-card__title'>
          {`${getTitle(beatmapset)} `}
          <span className='beatmapset-search-card__title-artist'>
            {trans('users.show.extra.beatmaps.by_artist', { artist: getArtist(beatmapset) })}
          </span>
        </div>

        <div className='beatmapset-search-card__extra'>
          {trans('beatmapsets.show.details.mapped_by', { mapper: beatmapset.creator })}
        </div>
      </div>
    </a>
  );
}
