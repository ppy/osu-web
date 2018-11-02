/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

import { ChatChannelSwitchAction } from 'actions/chat-actions';
import { inject, observer } from 'mobx-react';
import * as React from 'react';
import RootDataStore from 'stores/root-data-store';

@inject('dataStore')
@inject('dispatcher')
@observer
export default class ConversationListItem extends React.Component<any, {}> {
  switch = (e: React.MouseEvent<HTMLElement>) => {
    e.preventDefault();

    if (this.props.dataStore.uiState.chat.selected !== this.props.channel_id) {
      this.props.dispatcher.dispatch(new ChatChannelSwitchAction(this.props.channel_id));
    }
  }

  render(): React.ReactNode {
    const dataStore: RootDataStore = this.props.dataStore;
    const uiState = dataStore.uiState.chat;
    const conversation = dataStore.channelStore.getOrCreate(this.props.channel_id);
    const selected = this.props.channel_id === uiState.selected;

    let className = 'conversation-list-item';
    if (selected) {
      className += ' conversation-list-item--selected';
    }

    if (conversation.isUnread) {
      className += ' conversation-list-item--unread';
    }

    return (
      <a href='#' className={className} onClick={this.switch}>
        <div className='conversation-list-item__unread-indicator' />
        <img className='conversation-list-item__avatar' src={conversation.icon} />
        <div className='conversation-list-item__name'>{conversation.name}</div>
        <div className='conversation-list-item__chevron'>
          <i className='fas fa-chevron-right' />
        </div>
      </a>
    );
  }
}
