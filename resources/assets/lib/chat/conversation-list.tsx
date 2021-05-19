// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import ConversationListItem from './conversation-list-item';

@observer
export default class ConversationList extends React.Component {
  private get nonPmChannels() {
    return core.dataStore.channelStore.nonPmChannels;
  }

  private get pmChannels() {
    return core.dataStore.channelStore.pmChannels;
  }

  render(): React.ReactNode {
    return (
      <div className='chat-conversation-list'>
        {this.renderNonPmChannels()}
        {this.renderSeparator()}
        {this.renderPmChannels()}
      </div>
    );
  }

  private renderNonPmChannels() {
    return this.nonPmChannels.map((conversation) => <ConversationListItem key={conversation.channelId} channelId={conversation.channelId} />);
  }

  private renderPmChannels() {
    return this.pmChannels.map((conversation) => <ConversationListItem key={conversation.channelId} channelId={conversation.channelId} />);
  }

  private renderSeparator() {
    if (this.nonPmChannels.length === 0 || this.pmChannels.length === 0) {
      return null;
    }

    return <div className='chat-conversation-list-separator' />;
  }
}
