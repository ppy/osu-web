// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import Channel from 'models/chat/channel';
import core from 'osu-core-singleton';
import * as React from 'react';
import ConversationListItem from './conversation-list-item';

@observer
export default class ConversationList extends React.Component {
  private get publicChannels() {
    return core.dataStore.channelStore.publicChannels;
  }

  private get pmChannels() {
    return core.dataStore.channelStore.pmChannels;
  }

  render(): React.ReactNode {
    return (
      <div className='chat-conversation-list'>
        {this.renderChannels(this.publicChannels)}
        {this.renderSeparator()}
        {this.renderChannels(this.pmChannels)}
      </div>
    );
  }

  private renderChannels(channels: Channel[]) {
    return channels.map((conversation) => <ConversationListItem key={conversation.channelId} channelId={conversation.channelId} />);
  }

  private renderSeparator() {
    if (this.publicChannels.length === 0 || this.pmChannels.length === 0) {
      return null;
    }

    return <div className='chat-conversation-list-separator' />;
  }
}
