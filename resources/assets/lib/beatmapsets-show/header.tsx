// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import GameMode from 'interfaces/game-mode';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';
import { UserLink } from 'user-link';
import { getArtist, getTitle } from 'utils/beatmap-helper';
import BeatmapList from './beatmap-list';
import BeatmapPicker from './beatmap-picker';

interface Props {
  beatmaps: Map<GameMode, BeatmapJsonExtended[]>;
  beatmapset: BeatmapsetJson;
  currentBeatmap: BeatmapJsonExtended;
}

@observer
export default class Header extends React.Component<Props> {
  render() {
    const beatmaps = this.props.beatmaps.get(this.props.currentBeatmap.mode) ?? [];

    return (
      <div className='beatmapset-header'>
        <div className='beatmapset-header__title-container u-ellipsis-overflow'>
          <span className='beatmapset-header__title'>
            <a
              className='beatmapset-header__text-link'
              href={route('beatmapsets.index', { q: getTitle(this.props.beatmapset) })}
            >
              {getTitle(this.props.beatmapset)}
            </a>
          </span>

          <span className='beatmapset-header__artist'>
            <StringWithComponent
              mappings={{
                ':artist':
                  <a
                    key='artist'
                    className='beatmapset-header__text-link'
                    href={route('beatmapsets.index', { q: getArtist(this.props.beatmapset) })}
                  >
                    {getArtist(this.props.beatmapset)}
                  </a>,
              }}
              pattern={osu.trans('beatmapsets.show.details.by_artist')}
            />
          </span>
        </div>


        <div className='beatmapset-header__creator'>
          <StringWithComponent
            mappings={{
              ':creator':
                <UserLink
                  key='creator'
                  user={{ id: this.props.beatmapset.user_id, username: this.props.beatmapset.creator }}
                />,
            }}
            pattern={osu.trans('beatmapsets.show.details.created_by')}
          />
        </div>

        <div className='beatmapset-header__picker'>
          <BeatmapList
            beatmaps={beatmaps}
            currentBeatmap={this.props.currentBeatmap}
            type='show'
          />
          <BeatmapPicker
            beatmaps={beatmaps}
            currentBeatmap={this.props.currentBeatmap}
          />
        </div>
      </div>
    );
  }
}
