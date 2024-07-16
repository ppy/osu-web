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
import { toJS } from 'mobx';

interface BaseProps {
  beatmap: BeatmapJson | BeatmapExtendedJson;
  beatmapUrl?: string;
  inline?: boolean;
  modifiers?: Modifiers;
}

type MapperProps = {
  beatmapset: BeatmapsetJson;
  // mappers?: Mapper[] | null;
  showMappers: true;
  showNonGuestMapper: boolean;
} | {
  // mappers: null;
  showMappers: false;
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
              {this.renderMappers()}
            </span>
          </div>
        </div>
      </div>
    );
  }

  private renderMappers() {
    if (!this.props.showMappers) return null;

    const mappers = this.props.beatmap.mappers;
    if (mappers == null || mappers.length === 0) {
      return null;
    }

    const isGuestMap = mappers.length > 1
      || mappers[0].id !== this.props.beatmapset.user_id;

    // TODO:
    if (!isGuestMap && !this.props.showNonGuestMapper) {
      return null;
    }

    const translationKey = isGuestMap
      ? 'mapped_by_guest'
      : 'mapped_by';

    const mapper = isGuestMap
      ? mappers.map((user) => <UserLink key={user.id} user={user} />)
      : <UserLink user={{ id: this.props.beatmapset.user_id, username: this.props.beatmapset.creator }} />;

    return (
      <StringWithComponent
        mappings={{ mapper }}
        pattern={trans(`beatmapsets.show.details.${translationKey}`)}
      />
    );
  }
}
