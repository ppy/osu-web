/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { ChatChannelPartAction, ChatChannelSwitchAction } from 'actions/chat-actions';
import { dispatch } from 'app-dispatcher';
import { inject, observer } from 'mobx-react';
import * as React from 'react';
import RootDataStore from 'stores/root-data-store';

@inject('dataStore')
@observer
export default class ConversationListItem extends React.Component<any, {}> {
  part = (e: React.MouseEvent<HTMLElement>) => {
    dispatch(new ChatChannelPartAction(this.props.channelId));
  }

  render(): React.ReactNode {
    const dataStore: RootDataStore = this.props.dataStore;
    const uiState = dataStore.uiState.chat;
    const conversation = dataStore.channelStore.get(this.props.channelId);
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
        <button className={`${baseClassName}__close-button`} onClick={this.part}>
          <i className='fas fa-times' />
        </button>
        <div className={`${baseClassName}__unread-indicator`} />
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

  switch = (e: React.MouseEvent<HTMLElement>) => {
    if (this.props.dataStore.uiState.chat.selected !== this.props.channelId) {
      dispatch(new ChatChannelSwitchAction(this.props.channelId));
    }
  }
}
