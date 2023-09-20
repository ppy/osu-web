// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import UserRelationJson from 'interfaces/user-relation-json';
import { route } from 'laroute';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import UserCardTypeContext from 'user-card-type-context';
import { classWithModifiers, groupColour, Modifiers } from 'utils/css';

interface Props {
  modifiers?: Modifiers;
  onRemoveClick?: (user: UserJson) => void;
  user: UserJson;
}

@observer
export default class UserCardBrick extends React.Component<Props> {
  static readonly contextType = UserCardTypeContext;

  declare context: React.ContextType<typeof UserCardTypeContext>;

  private ref = React.createRef<HTMLDivElement>();

  @computed
  private get friendModifier() {
    if (core.currentUser?.friends == null) return;

    const friendState = core.currentUser.friends.find((friend: UserRelationJson) => friend.target_id === this.props.user.id);

    if (friendState != null) {
      if (friendState.mutual) return 'mutual';

      if (!this.context.isFriendsPage) return 'friend';
    }
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentWillUnmount() {
    $.publish('user-card:remove', this.ref.current);
  }

  render() {
    const blockClass = classWithModifiers(
      'user-card-brick',
      this.props.modifiers,
      this.friendModifier,
    );

    const group = this.props.user.groups != null && this.props.user.groups.length > 0
      ? this.props.user.groups[0]
      : undefined;

    return (
      <div ref={this.ref} className={`js-usercard ${blockClass}`} data-user-id={this.props.user.id}>
        <a
          className='user-card-brick__link'
          href={route('users.show', { user: this.props.user.id })}
        >
          <div
            className='user-card-brick__group-bar'
            style={groupColour(group)}
            title={group?.name}
          />

          <div className='user-card-brick__username u-ellipsis-overflow'>
            {this.props.user.username}
          </div>
        </a>
        {this.props.onRemoveClick != null && (
          <button className='user-card-brick__remove' onClick={this.handleRemoveClick}>
            <span className='fas fa-times' />
          </button>
        )}
      </div>
    );
  }

  private handleRemoveClick = () => {
    this.props.onRemoveClick?.(this.props.user);
  };
}
