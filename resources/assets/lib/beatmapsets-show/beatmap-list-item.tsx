// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'beatmap-icon';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  beatmap: BeatmapJsonExtended;
  count?: number;
  iconOnly: boolean;
  large: boolean;
  mode?: string;
  withButton?: string;
}

export default class BeatmapListItem extends React.PureComponent<Props> {
  static defaultProps = {
    iconOnly: false,
    large: false,
  };

  render() {
    const deleted = this.props.beatmap.deleted_at !== null;
    let version = this.props.beatmap.version;

    if (deleted) {
      version += ` ${osu.trans('beatmap_discussions.index.deleted_beatmap')}`;
    }

    return (
      <div
        className={classWithModifiers('beatmap-list-item', {
          deleted,
          'icon-only': this.props.iconOnly,
          large: this.props.large,
        })}
      >
        {this.props.iconOnly
          ? this.renderIconOnly()
          : (
            <>
              <div className='beatmap-list-item__col'>
                <BeatmapIcon
                  beatmap={this.props.beatmap}
                  modifier={this.props.large ? 'large' : ''}
                />
              </div>

              <div className='beatmap-list-item__col beatmap-list-item__col--main'>
                <div className='u-ellipsis-overflow'>{version}</div>
              </div>

              {this.props.withButton !== undefined && (
                <div className='beatmap-list-item__col'>
                  <i className={`fas fa-chevron-${this.props.withButton}`} />
                </div>
              )}

              {this.props.count !== undefined && (
                <div className='beatmap-list-item__col'>
                  <div className='beatmap-list-item__counter'>{this.props.count}</div>
                </div>
              )}
            </>
          )
        }
      </div>
    );
  }

  renderIconOnly() {
    return (
      <div className='beatmap-list-item__icon-only'>
        {Array.from({ length: 4 }).map((_, idx) => (
          <BeatmapIcon
            key={idx}
            beatmap={this.props.beatmap}
            modifier='beatmap-list-icon-only'
            showTitle={false}
          />
        ))}
      </div>
    );
  }
}
