// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'beatmap-icon';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  beatmap: BeatmapExtendedJson;
  count?: number;
  large: boolean;
  withButton?: string;
}

export default class BeatmapListItem extends React.PureComponent<Props> {
  static defaultProps = {
    large: false,
  };

  render() {
    const deleted = this.props.beatmap.deleted_at !== null;
    const version = `${this.props.beatmap.version}${deleted ? ` [${osu.trans('beatmap_discussions.index.deleted_beatmap')}]` : ''}`;

    return (
      <div
        className={classWithModifiers('beatmap-list-item', {
          deleted,
          large: this.props.large,
        })}
      >
        <div className='beatmap-list-item__col'>
          <BeatmapIcon
            beatmap={this.props.beatmap}
            modifier={this.props.large ? 'large' : undefined}
          />
        </div>

        <div className='beatmap-list-item__col beatmap-list-item__col--main'>
          <div className='u-ellipsis-pre-overflow'>
            {version}
          </div>
        </div>

        {this.props.withButton !== undefined && (
          <div className='beatmap-list-item__col'>
            <i className={this.props.withButton} />
          </div>
        )}

        {this.props.count !== undefined && (
          <div className='beatmap-list-item__col'>
            <div className='beatmap-list-item__counter'>
              {this.props.count}
            </div>
          </div>
        )}
      </div>
    );
  }
}
