// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserLinkList from 'beatmap-discussions/user-link-list';
import DifficultyBadge from 'components/difficulty-badge';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import { hasOwners } from 'interfaces/with-beatmap-owners';
import * as React from 'react';
import { hasGuestOwners } from 'utils/beatmap-helper';
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
  showNonGuestOwner: boolean;
  showOwners: true;
} | {
  showOwners: false;
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
            {this.props.beatmapUrl != null
              ? <a className='beatmap-list-item__version-link' href={this.props.beatmapUrl}>{version}</a>
              : version}
            {' '}
            <span className='beatmap-list-item__mapper'>
              {this.renderOwners()}
            </span>
          </div>
        </div>
      </div>
    );
  }

  private renderOwners() {
    if (!this.props.showOwners) return null;

    const owners = this.props.beatmap.owners;
    if (owners == null || owners.length === 0) {
      return null;
    }

    const userId = this.props.beatmapset.user_id;
    const visibleOwners = this.props.showNonGuestOwner
      ? owners
      : owners.filter((mapper) => mapper.id !== userId);

    if (visibleOwners.length === 0) {
      return null;
    }

    const translationKey = hasOwners(this.props.beatmap) && hasGuestOwners(this.props.beatmap, this.props.beatmapset)
      ? 'mapped_by_guest'
      : 'mapped_by';

    return (
      <StringWithComponent
        mappings={{ mapper: <UserLinkList users={visibleOwners} /> }}
        pattern={trans(`beatmapsets.show.details.${translationKey}`)}
      />
    );
  }
}
