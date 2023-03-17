// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DifficultyBadge from 'components/difficulty-badge';
import UserLink from 'components/user-link';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import UserJson from 'interfaces/user-json';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { trans } from 'utils/lang';
import StringWithComponent from './string-with-component';

interface BaseProps {
  beatmap: BeatmapJson | BeatmapExtendedJson;
  beatmapUrl?: string;
  inline?: boolean;
  modifiers?: Modifiers;
}

type MapperProps = {
  beatmapset: BeatmapsetJson;
  mapper: Pick<UserJson, 'id' | 'username'>;
  showNonGuestMapper: boolean;
} | {
  mapper: null;
};

type Props = BaseProps & MapperProps;

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
            {this.props.beatmapUrl
              ? <a className='beatmap-list-item__version-link' href={this.props.beatmapUrl}>{version}</a>
              : version}
            {' '}
            <span className='beatmap-list-item__mapper'>
              {this.renderMapper()}
            </span>
          </div>
        </div>
      </div>
    );
  }

  private renderMapper() {
    if (this.props.mapper == null) {
      return null;
    }

    const isGuestMap = this.props.beatmapset.user_id !== this.props.beatmap.user_id;

    if (!isGuestMap && !this.props.showNonGuestMapper) {
      return null;
    }

    const translationKey = isGuestMap
      ? 'mapped_by_guest'
      : 'mapped_by';

    const mapper = isGuestMap
      ? this.props.mapper
      : { id: this.props.beatmapset.user_id, username: this.props.beatmapset.creator };

    return (
      <StringWithComponent
        mappings={{
          mapper: <UserLink user={mapper} />,
        }}
        pattern={trans(`beatmapsets.show.details.${translationKey}`)}
      />
    );
  }
}
