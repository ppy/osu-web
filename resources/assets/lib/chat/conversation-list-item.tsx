// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserAvatar from 'components/user-avatar';
import { observer } from 'mobx-react';
import Channel from 'models/chat/channel';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  channel: Channel;
}

@observer
export default class ConversationListItem extends React.Component<Props> {
  render() {
    const uiState = core.dataStore.chatState;
    const baseClassName = 'chat-conversation-list-item';

    const selected = this.props.channel.channelId === uiState.selected;

    return (
      <div className={classWithModifiers(baseClassName, { selected })}>
        {this.props.channel.isUnread && !selected
          ? <div className={`${baseClassName}__unread-indicator`} />
          : null}

        <button className={`${baseClassName}__close-button`} onClick={this.part}>
          <i className='fas fa-times' />
        </button>

        <button className={`${baseClassName}__tile`} onClick={this.switch}>
          <div className={`${baseClassName}__avatar`}>
            <UserAvatar modifiers='full-circle' user={{ avatar_url: this.props.channel.icon }} />
          </div>
          <div className={`${baseClassName}__name`}>{this.props.channel.name}</div>
          <div className={`${baseClassName}__chevron`}>
            <i className='fas fa-chevron-right' />
          </div>
        </button>
      </div>
    );
  }

  private part = () => {
    core.dataStore.channelStore.partChannel(this.props.channel.channelId);
  };

  private switch = () => {
    core.dataStore.chatState.selectChannel(this.props.channel.channelId);
  };
}
