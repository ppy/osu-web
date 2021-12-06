// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import RootDataStore from 'stores/root-data-store';
import UserAvatar from 'user-avatar';

interface Props {
  channelId: number;
  dataStore?: RootDataStore;
}

@observer
export default class ConversationListItem extends React.Component<Props> {
  render(): React.ReactNode {
    const uiState = core.dataStore.chatState;
    const conversation = core.dataStore.channelStore.get(this.props.channelId);
    const baseClassName = 'chat-conversation-list-item';

    if (!conversation) {
      return;
    }

    let className = baseClassName;
    if (this.props.channelId === uiState.selected) {
      className += ` ${baseClassName}--selected`;
    }

    if (conversation.isUnread) {
      className += ` ${baseClassName}--unread`;
    }

    return (
      <div className={className}>
        {conversation.isUnread
          ? <div className={`${baseClassName}__unread-indicator`} />
          : null}

        <button className={`${baseClassName}__close-button`} onClick={this.part}>
          <i className='fas fa-times' />
        </button>

        <button className={`${baseClassName}__tile`} onClick={this.switch}>
          <div className={`${baseClassName}__avatar`}>
            <UserAvatar modifiers={['full-circle']} user={{ avatar_url: conversation.icon }} />
          </div>
          <div className={`${baseClassName}__name`}>{conversation.name}</div>
          <div className={`${baseClassName}__chevron`}>
            <i className='fas fa-chevron-right' />
          </div>
        </button>
      </div>
    );
  }

  private part = () => {
    core.dataStore.channelStore.partChannel(this.props.channelId);
  };

  private switch = () => {
    core.dataStore.chatState.selectChannel(this.props.channelId);
  };
}
