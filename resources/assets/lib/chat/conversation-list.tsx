// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import Channel, { channelGroups } from 'models/chat/channel';
import core from 'osu-core-singleton';
import * as React from 'react';
import ConversationListItem from './conversation-list-item';

@observer
export default class ConversationList extends React.Component {
  render(): React.ReactNode {
    return (
      <div className='chat-conversation-list'>
        {channelGroups.map((group) => (
          <React.Fragment key={group}>
            {this.renderChannels(core.dataStore.channelStore.groupedChannels[group])}
            {this.renderSeparator()}
          </React.Fragment>
        ))}
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
