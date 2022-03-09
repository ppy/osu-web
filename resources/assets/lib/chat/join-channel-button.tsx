// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import * as React from 'react';

export default class JoinChannelButton extends React.Component {
  render() {
    return (
      <div className='chat-conversation-list-item'>
        <button className='chat-conversation-list-item__tile' onClick={this.handleClick}>
          <div className='chat-conversation-list-item__avatar'>
            <span className='avatar avatar--join-channel'>
              <span className='fas fa-plus' />
            </span>
          </div>
          <div className='chat-conversation-list-item__name'>{osu.trans('chat.channels.join')}</div>
        </button>
      </div>
    );
  }

  private handleClick = () => {
    core.dataStore.chatState.showJoinChannel();
  };
}
