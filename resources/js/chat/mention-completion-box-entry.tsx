// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserAvatar from 'components/user-avatar';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import MentionCompletionBoxState, { UserSearchEntry } from './mention-completion-box-state';

interface Props {
  active: boolean;
  state: MentionCompletionBoxState;
  user: UserSearchEntry;
}

export default class MentionCompletionBoxEntry extends React.Component<Props> {
  render() {
    return (
      <button
        className={classWithModifiers('chat-mention-completion-box-entry', { active: this.props.active })}
        onClick={this.handleClick}
        type='button'
      >
        <span className='chat-mention-completion-box-entry__avatar'>
          <UserAvatar modifiers='full-circle' user={this.props.user} />
        </span>
        <span className='u-ellipis-overflow'>
          {this.props.user.username}
        </span>
      </button>
    );
  }

  private readonly handleClick = () => {
    this.props.state.insertUsername(this.props.user);
  };
}
