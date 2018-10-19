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
import { observer, Provider } from 'mobx-react';
import DevTools from 'mobx-react-devtools';
import Channel from 'models/chat/channel';
import User from 'models/user';
import * as React from 'react';
import ConversationList from './conversation-list';
import ConversationView from './conversation-view';
import InputBox from './input-box';

@observer
export default class MainView extends React.Component<any, any> {

  constructor(props: any) {
    super(props);

    if (!_.isEmpty(props.presence)) {
      this.props.dataStore.channelStore.updatePresence(props.presence);
    }
  }

  componentDidMount() {
    $('html').addClass('osu-layout--mobile-app');

    this.init();
  }

  init = () => {
    const sendTo = osu.parseJson('json-sendto');
    let channelId: number;

    if (!_.isEmpty(sendTo)) {
      const target: User = this.props.dataStore.userStore.getOrCreate(sendTo.target.id, sendTo.target); // pre-populate userStore with target
      let channel: Channel = this.props.dataStore.channelStore.findPM(target.id);

      if (channel) {
        channelId = channel.channelId;
        this.props.dispatcher.dispatch(new ChatChannelSwitchAction(channelId));
      } else {
        channel = new Channel(-1);
        channel.newChannel = true;
        channel.channelId = -1;
        channel.name = target.username;
        channel.icon = target.avatarUrl;
        channel.type = 'PM';
        channel.users = [currentUser.id, target.id];

        this.props.dataStore.channelStore.channels.set(-1, channel);
        this.props.dispatcher.dispatch(new ChatChannelSwitchAction(-1));
      }
    } else {
      if (!_.isEmpty(this.props.presence)) {
        channelId = this.props.dataStore.channelStore.sortedByPresence[0].channelId;
        this.props.dispatcher.dispatch(new ChatChannelSwitchAction(channelId));
      } else {
        console.log('presence missing...?');
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
            <ConversationView />
            <InputBox />
            <DevTools />
          </div>
        </div>
      </Provider>
    );
  }
}
