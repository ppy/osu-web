// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { inject, observer } from 'mobx-react';
import Channel from 'models/chat/channel';
import * as React from 'react';
import ConversationListItem from './conversation-list-item';

@inject('dataStore')
@observer
export default class ConversationList extends React.Component<any, {}> {
  render(): React.ReactNode {
    const nonPmChannels: Channel[] = this.props.dataStore.channelStore.nonPmChannels;
    const pmChannels: Channel[] = this.props.dataStore.channelStore.pmChannels;
    const conversationList: React.ReactNode[] = [];

    nonPmChannels.forEach((conversation) => {
      conversationList.push(<ConversationListItem key={conversation.channelId} channelId={conversation.channelId} />);
    });

    if (nonPmChannels.length > 0 && pmChannels.length > 0) {
      conversationList.push(
        <div key='separator' className='chat-conversation-list-separator' />,
      );
    }

    pmChannels.forEach((conversation) => {
      conversationList.push(<ConversationListItem key={conversation.channelId} channelId={conversation.channelId} />);
    });

    return <div className='chat-conversation-list'>{conversationList}</div>;
  }
}
