// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetJson from 'interfaces/beatmapset-json';
import { route } from 'laroute';
import * as React from 'react';
import { getArtist, getTitle } from 'utils/beatmap-helper';
import { trans } from 'utils/lang';
import BeatmapsetCover from './beatmapset-cover';

interface Props {
  beatmapset?: BeatmapsetJson;
}

export default class BeatmapsetListView extends React.PureComponent<Props> {
  render() {
    if (this.props.beatmapset == null) {
      return (
        <div className='beatmapset-list-view'>
          <div className='beatmapset-list-view__cover-container beatmapset-list-view__cover-container--blank' />

          <div className='beatmapset-list-view__content'>
            <div className='beatmapset-list-view__title'>
              {trans('beatmapsets.panel.empty')}
            </div>
          </div>
        </div>
      );
    }

    return (
      <a
        className='beatmapset-list-view'
        href={route('beatmapsets.show', { beatmapset: this.props.beatmapset.id })}
      >
        <div className='beatmapset-list-view__cover-container'>
          <BeatmapsetCover beatmapset={this.props.beatmapset} modifiers='full' size='card' />
        </div>
        <div className='beatmapset-list-view__content'>
          <div className='beatmapset-list-view__title u-ellipsis-overflow'>
            {getTitle(this.props.beatmapset)}
            <span className='beatmapset-list-view__artist'>
              {trans('users.show.extra.beatmaps.by_artist', { artist: getArtist(this.props.beatmapset) })}
            </span>
          </div>

          <div className='beatmapset-status beatmapset-status--list-view'>
            {trans(`beatmapsets.show.status.${this.props.beatmapset.status}`)}
          </div>
        </div>
      </a>
    );
  }
}
