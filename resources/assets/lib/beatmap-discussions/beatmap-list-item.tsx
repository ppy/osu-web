// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DifficultyBadge from 'components/difficulty-badge';
import StringWithComponent from 'components/string-with-component';
import { UserLink } from 'components/user-link';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import UserJson from 'interfaces/user-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  beatmap: BeatmapExtendedJson;
  beatmapset: BeatmapsetJson;
  count?: number;
  large: boolean;
  mapper: UserJson;
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
        <div className={classWithModifiers('beatmap-list-item__col', 'icon', { 'icon-large': this.props.large })}>
          <i className={`fal fa-extra-mode-${this.props.beatmap.mode}`} />
        </div>

        <div className='beatmap-list-item__col'>
          <DifficultyBadge rating={this.props.beatmap.difficulty_rating} />
        </div>

        <div className='beatmap-list-item__col beatmap-list-item__col--main'>
          <div className='u-ellipsis-overflow'>
            <span className='beatmap-list-item__version'>
              {version}
            </span>
            {this.props.beatmapset.user_id !== this.props.beatmap.user_id && (
              <>
                {' '}
                <span className='beatmap-list-item__mapper'>
                  <StringWithComponent
                    mappings={{
                      mapper: <UserLink user={this.props.mapper} />,
                    }}
                    pattern={osu.trans('beatmapsets.show.details.mapped_by')}
                  />
                </span>
              </>
            )}
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
