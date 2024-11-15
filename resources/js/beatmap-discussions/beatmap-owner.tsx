// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserAvatar from 'components/user-avatar';
import UserLink from 'components/user-link';
import BeatmapOwnerJson from 'interfaces/beatmap-owner-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  editing: boolean;
  onRemoveUser?: (user: BeatmapOwnerJson) => void;
  user: BeatmapOwnerJson;
}

function createRemoveOwnerHandler(user: BeatmapOwnerJson, onRemoveClick?: NonNullable<Props['onRemoveUser']>) {
  return (event: React.MouseEvent<HTMLButtonElement>) => {
    event.preventDefault();
    onRemoveClick?.(user);
  };
}

export default class BeatmapOwner extends React.PureComponent<Props> {
  render() {
    return (
      <div className='beatmap-owner'>
        <UserLink className='beatmap-owner__user' tooltipPosition='top right' user={this.props.user}>
          <div className='beatmap-owner__avatar'>
            <UserAvatar modifiers='full-circle' user={this.props.user} />
          </div>
          <div className='u-ellipsis-overflow'>
            {this.props.user.username}
          </div>
        </UserLink>

        <button
          className={classWithModifiers('beatmap-owner__remove', { editing: this.props.editing })}
          onClick={createRemoveOwnerHandler(this.props.user, this.props.onRemoveUser)}
        >
          <span className='fas fa-times' />
        </button>

      </div>
    );
  }
}
