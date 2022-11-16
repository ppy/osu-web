// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DifficultyBadge from 'components/difficulty-badge';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapJson from 'interfaces/beatmap-json';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { trans } from 'utils/lang';

interface Props {
  beatmap: BeatmapJson | BeatmapExtendedJson;
  inline?: boolean;
  modifiers?: Modifiers;
}

export default class BeatmapListItem extends React.PureComponent<Props> {
  render() {
    const deleted = 'deleted_at' in this.props.beatmap && this.props.beatmap.deleted_at !== null;
    const version = `${this.props.beatmap.version}${deleted ? ` [${trans('beatmap_discussions.index.deleted_beatmap')}]` : ''}`;

    return (
      <div className={classWithModifiers('beatmap-list-item', { deleted, inline: this.props.inline }, this.props.modifiers)}>
        <div className='beatmap-list-item__col beatmap-list-item__col--icon'>
          <span className={`fal fa-extra-mode-${this.props.beatmap.mode}`} />
        </div>

        <div className='beatmap-list-item__col'>
          <DifficultyBadge rating={this.props.beatmap.difficulty_rating} />
        </div>

        <div className='beatmap-list-item__col beatmap-list-item__col--main'>
          <div className={`beatmap-list-item__version ${this.props.inline ? '' : 'u-ellipsis-overflow'}`}>
            {version}
          </div>
        </div>
      </div>
    );
  }
}
