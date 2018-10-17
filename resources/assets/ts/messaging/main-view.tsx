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

import * as React from 'react';
import { observer, Provider } from 'mobx-react';
import DevTools from 'mobx-react-devtools';

import ConversationList from './conversation-list';
import Conversation from './conversation';
import ChatInput from './chat-input';
import { ChatChannelSwitchAction } from 'actions/chat-actions';
import User from 'models/user';
import Channel from 'models/chat/channel';

@observer
export default class MainView extends React.Component<any, any> {

  constructor(props) {
    super(props)

    if (!_.isEmpty(props.presence)) {
      this.props.dataStore.channelStore.updatePresence(props.presence);
    }
  }

  componentDidMount() {
    $('html').addClass('osu-layout--mobile-app')

    this.init();
  }

  init = () => {
    console.log('MainView::init')

    let sendTo = osu.parseJson('json-sendto');
    let channel_id;

    if (!_.isEmpty(sendTo)) {
      let target: User = this.props.dataStore.userStore.getOrCreate(sendTo.target.id, sendTo.target); // pre-populate userStore with target
      let channel: Channel = this.props.dataStore.channelStore.findPM(target.id)

      if (channel) {
        channel_id = channel.channel_id;
        this.props.dispatcher.dispatch(new ChatChannelSwitchAction(channel_id));
      } else {
        channel = new Channel(-1);
        channel.newChannel = true;
        channel.channel_id = -1;
        channel.name = target.username;
        channel.icon = target.avatarUrl;
        channel.type = 'PM';
        channel.users = [currentUser.id, target.id];

        this.props.dataStore.channelStore.channels.set(-1, channel);
        this.props.dispatcher.dispatch(new ChatChannelSwitchAction(-1));
      }
    } else {
      if (!_.isEmpty(this.props.presence)) {
        channel_id = this.props.dataStore.channelStore.sortedByPresence[0].channel_id;
        this.props.dispatcher.dispatch(new ChatChannelSwitchAction(channel_id));
      }
    }

    this.props.worker.startPolling();
  }

  componentWillUnmount() {
    this.props.worker.stopPolling();
    $('html').removeClass('osu-layout--mobile-app');
  }

  render(): React.ReactNode {
    return(
      <Provider dataStore={this.props.dataStore} dispatcher={this.props.dispatcher}>
        <div className='messaging'>
          <ConversationList />
          <div className='messaging__conversation-window'>
            <Conversation />
            <ChatInput />
            <DevTools />
          </div>
        </div>
      </Provider>
    );
  }
}
