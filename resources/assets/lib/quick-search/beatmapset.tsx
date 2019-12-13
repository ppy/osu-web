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

import { BeatmapsetJSON } from 'beatmapsets/beatmapset-json';
import { Img2x } from 'img2x';
import { route } from 'laroute';
import * as React from 'react';

export default function Beatmapset({ beatmapset, modifiers = [] }: { beatmapset: BeatmapsetJSON, modifiers?: string[] }) {
  const url = route('beatmapsets.show', { beatmapset: beatmapset.id });

  return (
    <a className={osu.classWithModifiers('beatmapset-search-card', modifiers)} href={url}>
      <div className='beatmapset-search-card__cover-container'>
        <Img2x className='beatmapset-search-card__cover' src={beatmapset.covers.list} />
      </div>
      <div className='beatmapset-search-card__details'>
        <div className='beatmapset-search-card__title'>
          {`${beatmapset.title} `}
          <span className='beatmapset-search-card__title-artist'>
            {osu.trans('users.show.extra.beatmaps.by_artist', { artist: beatmapset.artist })}
          </span>
        </div>

        <div className='beatmapset-search-card__extra'>
          {osu.trans('beatmapsets.show.details.mapped_by', { mapper: beatmapset.creator })}
        </div>
      </div>
    </a>
  );
}
