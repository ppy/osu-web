// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';
import { UserLink } from 'user-link';

interface Props {
  beatmapset: BeatmapsetJson;
  currentBeatmap: BeatmapJsonExtended;
}

export default class Header extends React.PureComponent<Props> {
  render() {
    return (
      <div className='beatmapset-info'>
        <div className='beatmapset-info__difficulty'>
          <div className='beatmapset-info__diff-details'>
            <span className='beatmapset-info__diff-name'>
              {this.props.currentBeatmap.version}
            </span>
            <span className='beatmapset-info__diff-mapper'>
              <StringWithComponent
                mappings={{
                  ':mapper':
                    <UserLink
                      key='mapper'
                      user={{ id: this.props.beatmapset.user_id, username: this.props.beatmapset.creator }}
                    />,
                }}
                pattern={osu.trans('beatmapsets.show.details.mapped_by')}
              />
            </span>
          </div>
        </div>
      </div>
    );
  }
}
