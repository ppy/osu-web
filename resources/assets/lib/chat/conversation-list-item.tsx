// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatChannelPartAction } from 'actions/chat-actions';
import { dispatch } from 'app-dispatcher';
import { inject, observer } from 'mobx-react';
import * as React from 'react';
import RootDataStore from 'stores/root-data-store';

interface Props {
  channelId: number;
  dataStore?: RootDataStore;
}

@inject('dataStore')
@observer
export default class ConversationListItem extends React.Component<Props> {
  readonly dataStore: RootDataStore = this.props.dataStore!;

  render(): React.ReactNode {
    const uiState = this.dataStore.uiState.chat;
    const conversation = this.dataStore.channelStore.get(this.props.channelId);
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
          <img className={`${baseClassName}__avatar`} src={conversation.icon} />
          <div className={`${baseClassName}__name`}>{conversation.name}</div>
          <div className={`${baseClassName}__chevron`}>
            <i className='fas fa-chevron-right' />
          </div>
        </button>
      </div>
    );
  }

  private part = () => {
    dispatch(new ChatChannelPartAction(this.props.channelId));
  }

  private switch = () => {
    this.dataStore.uiState.chat.selectChannel(this.props.channelId);
  }
}
