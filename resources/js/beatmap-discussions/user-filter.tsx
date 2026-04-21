// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import mapperGroup from 'beatmap-discussions/mapper-group';
import SelectOptions from 'components/select-options';
import BeatmapsetDiscussionsStore from 'interfaces/beatmapset-discussions-store';
import UserJson from 'interfaces/user-json';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { usernameSortAscending } from 'models/user';
import * as React from 'react';
import { makeUrl, parseUrl } from 'utils/beatmapset-discussion-helper';
import { groupColour } from 'utils/css';
import { trans } from 'utils/lang';
import { getInt } from 'utils/math';
import DiscussionsState from './discussions-state';

const allUsers = Object.freeze({
  id: null,
  username: trans('beatmap_discussions.user_filter.everyone'),
});

interface Option {
  groups?: UserJson['groups'];
  id: UserJson['id'] | null;
  username: UserJson['username'];
}

interface Props {
  discussionsState: DiscussionsState;
  store: BeatmapsetDiscussionsStore;
}

@observer
export class UserFilter extends React.Component<Props> {
  private get ownerId() {
    return this.props.discussionsState.beatmapset.user_id;
  }

  // TODO: add actual multi user selection.
  @computed
  private get options() {
    const usersWithDicussions = new Map<number, UserJson>();
    for (const [, discussion] of this.props.store.discussions) {
      if (discussion.message_type === 'hype') continue;

      const user = this.props.store.users.get(discussion.user_id);
      if (user != null && !usersWithDicussions.has(user.id)) {
        usersWithDicussions.set(user.id, user);
      }
    }

    return [
      this.mapUserProperties(allUsers),
      ...[...usersWithDicussions.values()]
        .sort(usernameSortAscending)
        .map(this.mapUserProperties),
    ];
  }

  @computed
  private get text() {
    const selectedUsers = this.props.discussionsState.selectedUsers;
    if (selectedUsers.length === 0) {
      return trans('beatmap_discussions.user_filter.label');
    }

    const user = this.props.discussionsState.selectedUsers[0];
    return <span className='u-group-colour u-ellipsis-overflow' style={this.styleForUser(user)}>{user.username}</span>;
  }

  @computed
  private get urlOptions() {
    return parseUrl(this.props.discussionsState.url);
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    return (
      <SelectOptions
        blackout={false} // css sticky elements render on a different stacking context and always get covered by the blackout.
        href={this.props.discussionsState.url}
        modifiers='beatmap-discussions-user-filter'
        onSelect={this.handleSelect}
        options={this.options}
        selected={this.props.discussionsState.selectedUserIds}
      >
        {this.text}
      </SelectOptions>
    );
  }

  private getGroup(user: Option) {
    if (this.isOwner(user)) return mapperGroup;

    return user.groups?.[0];
  }

  @action
  private readonly handleSelect = (id?: string) => {
    const userId = getInt(id);
    this.props.discussionsState.selectedUserIds.clear();
    if (userId != null) {
      this.props.discussionsState.selectedUserIds.add(userId);
    }
  };

  private isOwner(user?: Option): boolean {
    return user != null && user.id === this.ownerId;
  }

  private readonly mapUserProperties = (user: Option) => {
    const urlOptions = structuredClone(this.urlOptions);
    // means it doesn't work on non-beatmapset discussion paths
    if (urlOptions != null) {
      urlOptions.users = user.id != null ? [user.id] : undefined;
    }

    return {
      href: urlOptions != null ? makeUrl(urlOptions) : '#',
      id: user.id,
      text: <span className='u-group-colour u-ellipsis-overflow' style={this.styleForUser(user)}>{user.username}</span>,
    };
  };

  private styleForUser(user: Option) {
    return groupColour(this.getGroup(user));
  }
}
