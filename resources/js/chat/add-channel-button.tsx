// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { AddChannelType } from './channel-id';

interface Props {
  type: AddChannelType;
}

@observer
export default class AddChannelButton extends React.Component<Props> {
  render() {
    if (this.props.type === 'create' && !core.dataStore.chatState.canChatAnnounce) return null;

    const modifiers = { selected: core.dataStore.chatState.selectedChannelOrType === this.props.type };

    return (
      <div className={classWithModifiers('chat-conversation-list-item', modifiers)}>
        <button className='chat-conversation-list-item__tile' onClick={this.handleClick}>
          <span className='chat-conversation-list-item__avatar'>
            <span className='avatar avatar--join-channel'>
              <span className='fas fa-plus' />
            </span>
          </span>
          <span className='chat-conversation-list-item__name'>{trans(`chat.channels.${this.props.type}`)}</span>
        </button>
      </div>
    );
  }

  private readonly handleClick = () => {
    core.dataStore.chatState.selectChannel(this.props.type);
  };
}
