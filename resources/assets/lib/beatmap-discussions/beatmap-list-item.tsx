// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'components/beatmap-icon';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';

interface Props {
  beatmap: BeatmapExtendedJson;
  count?: number;
  modifiers?: Modifiers;
  withButton?: string;
}

export default class BeatmapListItem extends React.PureComponent<Props> {
  render() {
    const deleted = this.props.beatmap.deleted_at !== null;
    const version = `${this.props.beatmap.version}${deleted ? ` [${osu.trans('beatmap_discussions.index.deleted_beatmap')}]` : ''}`;

    return (
      <div className={classWithModifiers('beatmap-list-item', { deleted }, this.props.modifiers)}>
        <div className='beatmap-list-item__col beatmap-list-item__col--icon'>
          <BeatmapIcon
            beatmap={this.props.beatmap}
            modifiers='beatmap-list-item'
            withTooltip
          />
        </div>

        <div className='beatmap-list-item__col beatmap-list-item__col--main'>
          <div className='u-ellipsis-overflow'>
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
