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

import * as React from "react";
import { inject, observer } from "mobx-react";
import RootDataStore from "../stores/root-data-store";
import { ChatChannelSwitchAction } from "../actions/chat-actions";

@inject('dataStore')
@inject('dispatcher')
@observer
export default class ConversationListItem extends React.Component<any, {}> {
  switch = (e) => {
    e.preventDefault()

    if (this.props.dataStore.uiState.chat.selected != this.props.channel_id) {
      this.props.dispatcher.dispatch(new ChatChannelSwitchAction(this.props.channel_id));
    }
  }

  render(): React.ReactNode {
    let dataStore: RootDataStore = this.props.dataStore;
    let uiState = dataStore.uiState.chat;
    let conversation = dataStore.channelStore.getOrCreate(this.props.channel_id);
    let selected = this.props.channel_id == uiState.selected;

    let className = 'messaging__conversation-list-item'
    if (selected)
      className += ' messaging__conversation-list-item--selected'
    if (conversation.isUnread)
      className += ' messaging__conversation-list-item--unread'

    return (
      <a href='#' className={className} onClick={this.switch}>
        <div className='messaging__conversation-list-unread' />
        <img className='messaging__conversation-list-item-av' src={conversation.icon} />
        <div className='messaging__conversation-list-item-name'>{conversation.name}</div>
        <div className='messaging__conversation-list-chevron'>
          <i className='fas fa-chevron-right' />
        </div>
      </a>
    );
  }
}


