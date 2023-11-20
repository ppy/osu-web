// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

@observer
export default class JoinChannelButton extends React.Component {
  render() {
    const modifiers = { selected: core.dataStore.chatState.showingJoinChannel };

    return (
      <div className={classWithModifiers('chat-conversation-list-item', modifiers)}>
        <button className='chat-conversation-list-item__tile' onClick={this.handleClick}>
          <div className='chat-conversation-list-item__avatar'>
            <span className='avatar avatar--join-channel'>
              <span className='fas fa-plus' />
            </span>
          </div>
          <div className='chat-conversation-list-item__name'>{trans('chat.channels.join')}</div>
        </button>
      </div>
    );
  }

  private readonly handleClick = () => {
    core.dataStore.chatState.selectChannel('join');
  };
}
