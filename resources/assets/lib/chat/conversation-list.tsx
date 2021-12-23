// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { supportedChannelTypes } from 'interfaces/chat/channel-json';
import { observer } from 'mobx-react';
import Channel from 'models/chat/channel';
import core from 'osu-core-singleton';
import * as React from 'react';
import AddChannelButton from './add-channel-button';
import ConversationListItem from './conversation-list-item';

@observer
export default class ConversationList extends React.Component {
  render(): React.ReactNode {
    return (
      <div className='chat-conversation-list'>
        {supportedChannelTypes.map((type) => (
          <React.Fragment key={type}>
            {this.renderChannels(core.dataStore.channelStore.groupedChannels[type])}
            {this.renderSeparator()}
          </React.Fragment>
        ))}
        <AddChannelButton />
      </div>
    );
  }

  private renderChannels(channels: Channel[]) {
    return channels.map((conversation) => <ConversationListItem key={conversation.channelId} channelId={conversation.channelId} />);
  }

  private renderSeparator() {
    return <div className='chat-conversation-list-separator' />;
  }
}
